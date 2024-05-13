<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Permissions\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'users' => UserResource::collection($this->collection),
            'total' => count($this->collection),
        ];
    }
}