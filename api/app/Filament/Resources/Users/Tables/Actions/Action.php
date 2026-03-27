<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Tables\Actions;

abstract class Action
{
    abstract public static function make(): \Filament\Actions\Action;
}
