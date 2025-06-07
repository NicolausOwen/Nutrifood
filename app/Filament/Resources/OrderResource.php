<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ticket_id')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('type')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ticket_id')
                    ->label('Ticket ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('verification_payment')
                    ->label('Status')
                    ->badge()
                    ->getStateUsing(function (Order $record): string {
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
                Tables\Columns\TextColumn::make('purchase_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Confirm Order')
                    ->button()
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Order $record) {

                        try {
                            $ticketController = app(\App\Http\Controllers\Api\TicketController::class);

                            $request = new \Illuminate\Http\Request(['id_user' => $record->user_id, 'type' => $record->type,
                            'name' => $record->name, 'umur' => $record->umur, 'jenis_kelamin' => $record->jenis_kelamin, 'asal' => $record->asal, 'nama_komunitas' => $record->nama_komunitas]);

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
                    ->hidden(fn (Order $record): bool => $record->verification_payment !== "False")
                    ->successNotificationTitle('Order marked as Confirmed'),
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
            'index' => Pages\ListOrders::route('/'),
            //'create' => Pages\CreatePayment::route('/create'),
            //'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
