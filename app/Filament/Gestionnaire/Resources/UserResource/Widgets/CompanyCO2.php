<?php

namespace App\Filament\Gestionnaire\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class CompanyCO2 extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user(); // Récupérez l'utilisateur connecté
        $companyId = $user->company_id;

        $totalPoints = User::where('company_id', $companyId)->sum('points');

        return [
            Stat::make('CO2 économisé', $totalPoints),
        ];
    }
}
