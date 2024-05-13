<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Permissions\RoleResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'roles' => RoleResource::collection($this->collection),
            'total' => count($this->collection),
        ];
    }
}