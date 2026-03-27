<?php

namespace App\Filament\Resources\Politicians\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class PoliticianInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('avatar_url'),
                TextEntry::make('canton.name')
                    ->label('Canton')
                    ->placeholder('-'),
                TextEntry::make('first_name')
                    ->label('First Name'),
                TextEntry::make('last_name')
                    ->label('Last Name'),
                TextEntry::make('slug'),
                TextEntry::make('bio')
                    ->html()
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('user_id')
                    ->label('Has User')
                    ->default(false)
                    ->boolean(),
                TextEntry::make('user.name')
                    ->label('User')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
