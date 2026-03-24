<?php

namespace App\Filament\Resources\Politicians\Pages;

use App\Filament\Resources\Politicians\PoliticianResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPoliticians extends ListRecords
{
    protected static string $resource = PoliticianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
