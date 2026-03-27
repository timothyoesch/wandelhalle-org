<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('politician_id')
                    ->relationship('politician', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name . ' (' . $record->id . ')')
                    ->searchable(["first_name", "last_name"])
                    ->native(false)
                    ->required(),
                Select::make('topics')
                    ->relationship('topics', 'name')
                    ->searchable()
                    ->native(false)
                    ->multiple()
                    ->required(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('rationale')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
