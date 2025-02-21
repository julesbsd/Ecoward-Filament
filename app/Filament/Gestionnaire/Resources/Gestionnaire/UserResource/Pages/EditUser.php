<?php

namespace App\Filament\Gestionnaire\Resources\Gestionnaire\UserResource\Pages;

use App\Filament\Gestionnaire\Resources\Gestionnaire\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
