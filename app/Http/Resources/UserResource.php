<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => [
                'id' => $this->role->id,
                'name' => $this->role->name,
            ],
            'points' => $this->points,
            'steps' => $this->steps,
            'profile_photo_url' => $this->profile_photo_path,
            'company' => $this->company ? [
                'id' => $this->company->id,
                'name' => $this->company->name,
                'email' => $this->company->email,
                'logo' => $this->company->logo,
                'website' => $this->company->website,
            ] : null,
            'actions' => $this->actions->map(function ($action) {
                return [
                    'id' => $action->id,
                    'location' => $action->location,
                    'status' => $action->status,
                    'created_at' => $action->created_at,
                    'updated_at' => $action->updated_at,
                    'quantity' => $action->quantity,
                    'points' => $action->trash->points * $action->quantity,
                    'trashname' => $action->trash->name,
                ];
            }),
        ];
    }
}
