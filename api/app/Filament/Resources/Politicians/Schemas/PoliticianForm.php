<?php

namespace App\Filament\Resources\Politicians\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class PoliticianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('canton_id')
                    ->relationship('canton', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug'),
                RichEditor::make('bio')
                    ->columnSpanFull(),
                TextInput::make('avatar_url')
                    ->url(),
            ]);
    }
}
