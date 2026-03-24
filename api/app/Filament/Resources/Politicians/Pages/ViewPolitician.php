<?php

namespace App\Filament\Resources\Politicians\Pages;

use App\Filament\Resources\Politicians\PoliticianResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPolitician extends ViewRecord
{
    protected static string $resource = PoliticianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
