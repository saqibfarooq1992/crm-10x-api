<?php

namespace App\Http\Resources\Permissions;

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
            'f_name' => $this->f_name,
            'm_name' => $this->m_name,
            'l_name' => $this->l_name,
            'n_name' => $this->n_name,
            'speciality' => $this->speciality,
            'avatar' => $this->avatar,
            'email' => $this->email,
            'permissions' => $this->whenLoaded('permissions'),
            'roles' => $this->whenLoaded('roles'),
        ];
    }
}
