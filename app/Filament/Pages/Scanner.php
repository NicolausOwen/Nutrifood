<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;

class Scanner extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static string $view = 'filament.pages.scanner';
    protected static ?string $navigationLabel = 'Scanner';
    protected static ?string $title = 'Scanner';
    protected static ?string $slug = 'scanner';

    public $qrCode;
    public $activeTarget = 'checkup';

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('qrCode')
                ->label('QR Code')
                ->hidden()
        ];
    }
}
