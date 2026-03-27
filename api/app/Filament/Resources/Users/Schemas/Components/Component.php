<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Schemas\Components;

use Filament\Forms\Components\Field;

abstract class Component
{
    abstract public static function make(): Field;
}
