<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Permissions\ContactResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'contacts' => ContactResource::collection($this->collection),
            'total' => count($this->collection),
        ];
    }
}