<?php

namespace App\Filament\Resources\Politicians\Pages;

use App\Filament\Resources\Politicians\PoliticianResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePolitician extends CreateRecord
{
    protected static string $resource = PoliticianResource::class;
}
