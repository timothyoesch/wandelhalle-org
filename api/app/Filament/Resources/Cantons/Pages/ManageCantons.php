<?php

namespace App\Filament\Resources\Cantons\Pages;

use App\Filament\Resources\Cantons\CantonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCantons extends ManageRecords
{
    protected static string $resource = CantonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
