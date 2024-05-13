<?php

namespace App\Http\Resources\Permissions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'contact_type' => $this->contact_type,
            'transaction_associate' => $this->transaction_associate,
            'assign_title' => $this->assign_title,
            'tags' => $this->tags,
            'f_name' => $this->f_name,
            'm_name' => $this->m_name,
            'l_name' => $this->l_name,
            'n_name' => $this->n_name,
            'email' => $this->email,
            'company' => $this->company,
            'cell_phone' => $this->cell_phone,
           'office_phone' => $this->office_phone, 

           'intrusted_in_properties' => $this->intrusted_in_properties,
            'preferred_contact_method' => $this->preferred_contact_method,
            'contact_source' => $this->contact_source,
           'contact_notes' => $this->contact_notes, 

           'attached_file' => $this->attached_file,
            'birthday' => $this->birthday,
            'hobbies' => $this->hobbies,
           'spouce' => $this->spouce,

           'children_name' => $this->children_name,
           'anniversary_date_of_purchase' => $this->anniversary_date_of_purchase,
          'anniversary_date_of_sale' => $this->anniversary_date_of_sale,
        ];
    }
}
