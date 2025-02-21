<?php

namespace App\Filament\Gestionnaire\Resources\Gestionnaire\UserResource\Pages;

use App\Filament\Gestionnaire\Resources\Gestionnaire\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
