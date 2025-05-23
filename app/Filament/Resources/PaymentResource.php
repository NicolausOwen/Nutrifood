<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ticket_id')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Textarea::make('payment_proof')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('verification_payment'),
                Forms\Components\DateTimePicker::make('verification_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Payment ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ticket_id')
                    ->label('Ticket ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('verification_payment')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (Payment $record): string {
                        $items = $record->verification_payment;

                        if($items === "True") {
                            $items = "Verified";
                        } else {
                            $items = "Not Verified";
                        }

                        return $items;
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Verified' => 'success',
                        'Not Verified' => 'danger',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('View Payment Proof')
                    ->url(fn (Payment $record): string => env('APP_URL').'/storage'. '/'.$record->payment_proof)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->hidden(fn (Payment $record): bool => $record->verification_payment !== "False")
                    ->openUrlInNewTab(),
                Action::make('Confirm Payment')
                    ->button()
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Payment $record) {

                        try {
                            $ticketController = app(\App\Http\Controllers\Api\TicketController::class);

                            $request = new \Illuminate\Http\Request(['id_user' => $record->user_id]);

                            $response = $ticketController->store($request);

                            $responseData = $response->getData();

                            if (isset($responseData->tickets->id)) {
                                $record->update(['verification_payment' => 'True']);
                                $record->update(['verification_at' => Carbon::now()]);
                                $record->update(['ticket_id' => $responseData->tickets->id]);
                                Notification::make()
                                    ->title('Berhasil')
                                    ->body('Ticket berhasil dibuat: ' . $responseData->tickets->id)
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Gagal')
                                    ->body('Gagal membuat ticket.')
                                    ->danger()
                                    ->send();
                            }
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body('Error: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->hidden(fn (Payment $record): bool => $record->verification_payment !== "False")
                    ->successNotificationTitle('Payment marked as Confirmed'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            //'create' => Pages\CreatePayment::route('/create'),
            //'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
