<?php

namespace App\Filament\Gestionnaire\Resources\UserResource\Widgets;

use App\Models\Action;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class CompanyAction extends BaseWidget
{


    protected function getStats(): array
    {
        $user = Auth::user(); // Récupérez l'utilisateur connecté
        $companyId = $user->company_id; // Récupérez le company_id de l'utilisateur connecté

        // Comptez les actions des utilisateurs ayant le même company_id
        $actionCount = Action::whereHas('user', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->count();
        return [
            Stat::make('Actions réalisées', $actionCount),
        ];
    }
}
