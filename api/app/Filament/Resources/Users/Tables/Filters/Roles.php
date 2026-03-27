<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Tables\Filters;

use Filament\Tables;

class Roles extends Filter
{
    public static function make(): Tables\Filters\SelectFilter
    {
        return Tables\Filters\SelectFilter::make('roles')
            ->label(trans('filament-users::user.resource.roles'))
            ->multiple()
            ->searchable()
            ->preload()
            ->relationship('roles', 'name');
    }
}
