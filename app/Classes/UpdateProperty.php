<?php

namespace App\Classes;

use App\Models\Property;
use App\Traits\Jsonify;

class UpdateProperty
{
    use Jsonify;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function updatePropertyInfo($data , $id)
    {
        try {
            $propertyInfo = Property::find($id);
            $propertyInfo =  $propertyInfo->update([
            'lead_id' => $data['lead_id'],
            'created_by' => $data['created_by'],
            'transaction_type' => $data['transaction_type'],
            'property_Type' => $data['property_Type'],
            'f_name' => $data['f_name'],
            'm_name' => $data['m_name'] ?? null,
            'l_name' => $data['l_name'],
            'nick_name' => $data['nick_name'] ?? null,
            'company' => $data['company'] ?? null,
            'email' => $data['email'] ?? null,
            'title' => $data['title'] ?? null,
            'phone' => $data['phone'] ?? null,
            'additional_phone' => $data['additional_phone'] ?? null,
            'anyone_else_on_deed' => $data['anyone_else_on_deed'] ?? null,
            'date' => $data['date'] ?? null,
            'Website' => $data['Website'] ?? null,
            'is_this_part_of_ortfolio' => $data['is_this_part_of_ortfolio'],
            // Update other properties accordingly
        ]);

        return $propertyInfo;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function updateAddressInfo($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateAddressAdditionalInfo($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateAssignmentInfo($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateBasicProperties($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updatePropertyDetail($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updatePropertyCondition($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updatePricing($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateUtilities($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateParcels($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateBuildings($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateStructures($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateDocumentation($data , $id)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
