<?php

namespace App\Filament\Resources\Politicians\Pages;

use App\Filament\Resources\Politicians\PoliticianResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPolitician extends EditRecord
{
    protected static string $resource = PoliticianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
