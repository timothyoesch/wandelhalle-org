<?php

namespace App\Filament\Resources\Councils\Pages;

use App\Filament\Resources\Councils\CouncilResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCouncils extends ManageRecords
{
    protected static string $resource = CouncilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
