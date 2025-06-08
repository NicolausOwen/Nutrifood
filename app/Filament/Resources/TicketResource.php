<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TicketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TicketResource\RelationManagers;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_user')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('checkup')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('makan')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('masuk')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('type')
                    ->numeric()
                    ->default(null),
                Forms\Components\Textarea::make('qr_code')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('masuk')
                    ->label('Check-In')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('checkup')
                    ->label('Race-Pack')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('makan')
                    ->label('Makan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('View QR')
                    ->label('View QR')
                    ->url(fn (Ticket $record): string => 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data='.$record->qr_code)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->openUrlInNewTab(),
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTickets::route('/'),
            // 'create' => Pages\CreateTicket::route('/create'),
            // 'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
