<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Permissions\PropertyResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'properties' => PropertyResource::collection($this->collection),
            'total' => count($this->collection),
        ];
    }
}