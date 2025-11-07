<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('mensaje')
                    ->required(),
                TextInput::make('numero')
                    ->required(),
                Toggle::make('estatus')
                    ->required(),
                DateTimePicker::make('fecha')
                    ->required(),
            ]);
    }
}
