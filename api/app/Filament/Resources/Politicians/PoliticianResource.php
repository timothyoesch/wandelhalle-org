<?php

namespace App\Filament\Resources\Politicians;

use App\Filament\Resources\Politicians\Pages\CreatePolitician;
use App\Filament\Resources\Politicians\Pages\EditPolitician;
use App\Filament\Resources\Politicians\Pages\ListPoliticians;
use App\Filament\Resources\Politicians\Pages\ViewPolitician;
use App\Filament\Resources\Politicians\Schemas\PoliticianForm;
use App\Filament\Resources\Politicians\Schemas\PoliticianInfolist;
use App\Filament\Resources\Politicians\Tables\PoliticiansTable;
use App\Models\Politician;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PoliticianResource extends Resource
{
    protected static ?string $model = Politician::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PoliticianForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PoliticianInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PoliticiansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MandatesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPoliticians::route('/'),
            'create' => CreatePolitician::route('/create'),
            'view' => ViewPolitician::route('/{record}'),
            'edit' => EditPolitician::route('/{record}/edit'),
        ];
    }
}
