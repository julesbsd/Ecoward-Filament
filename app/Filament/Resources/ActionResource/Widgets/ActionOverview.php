<?php

namespace App\Filament\Resources\ActionResource\Widgets;

use App\Models\Action;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nombre d\'actions', Action::count()),
        ];
    }
}
