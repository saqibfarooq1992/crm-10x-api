<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Permissions\LeadResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LeadCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'leads' => LeadResource::collection($this->collection),
            'total' => count($this->collection),
        ];
    }
}