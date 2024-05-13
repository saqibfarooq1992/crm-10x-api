<?php

namespace App\Services;

use App\Classes\CreateProperty;
use App\Classes\UpdateProperty;
use App\Http\Resources\Collections\PropertyCollection;
use App\Models\{
    AddressAdditionalInformation,
    BasicPropertyInformation,
    AssignmentInformation,
    DocumentNoteAndRemark,
    AddressInformation,
    PropertyCondition,
    OtherStructure,
    PropertyDetail,
    Building,
    Pricing,
    Parcel,
    Property,
    Utility
};
use App\Traits\Jsonify;

class PropertyServices
{
    use Jsonify;
    private $model;
    private $createProperty;
    private $updateProperty;
    /**
     * Create a new class instance.
     */
    public function __construct(Property $model , CreateProperty $createProperty , UpdateProperty $updateProperty)
    {
        $this->model = $model;
        $this->createProperty = $createProperty;
        $this->updateProperty = $updateProperty;
    }
    public function search()
    {
        try {
            $properties = $this->model->get();
            $data = (new PropertyCollection($properties));
            return self::jsonSuccess('Properties retrieved successfully.',$data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function show($property)
    {
        try {
            $property = $this->model->find($property);
            return self::jsonSuccess('Property retrieved successfully.',$property, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function delete($id)
    {
        try {
            $property = $this->model->find($id);
            $property->delete();
            return self::jsonSuccess('Property deleted successfully.',$property, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function create($request)
    {
        try {
            $data = $request->all();
            // Create the main property info
            $propertyInfo = $this->createProperty->propertyInfo($data);
            // Create the address info related to the property
            $addressInfo = $this->createProperty->addressInfo($data , $propertyInfo->id);
          
            // Create additional address information related to the property
            $addressAdditionalInfo = $this->createProperty->addressAdditionalInfo($data , $addressInfo->id);
            
            // Create assignment info related to the property
            $assignmentInfo = $this->createProperty->assignmentInfo($data , $propertyInfo->id);
            
           
            // Create basic properties related to the property
            $basicProperties = $this->createProperty->basicProperties($data , $addressInfo->id);
            
            
            // Create property detail related to the property
            $propertyDetail = $this->createProperty->propertyDetail($data , $addressInfo->id);
            
            
            // Create property condition related to the property
            $propertyCondition = $this->createProperty->propertyCondition($data , $addressInfo->id);
           
            // Create pricing related to the property
            $pricing = $this->createProperty->pricing($data , $addressInfo->id);
           
            // Create utilities related to the property
            $utilities = $this->createProperty->utilities($data , $addressInfo->id);
            
            // Create parcels related to the property
            $parcels = $this->createProperty->parcels($data , $addressInfo->id);
            
            // Create buildings related to the property
            $buildings = $this->createProperty->buildings($data , $addressInfo->id);
           
            // Create structures related to the property
            $structures = $this->createProperty->structures($data , $addressInfo->id);
            
            // Create documentation related to the property
            $documentation = $this->createProperty->documentation($data , $addressInfo->id);
            $properties = [$propertyInfo , $addressInfo , $addressAdditionalInfo , $assignmentInfo
             , $basicProperties , $buildings , $structures , $documentation , $parcels , $propertyDetail , $propertyCondition ,$pricing , $utilities ];
            return self::jsonSuccess('Property created successfully.', $properties, 200);
        } catch (\Throwable $th) {
            // Handle any exceptions
            dd($th);
        }
    }
    public function update($request , $property)
    {
        try {
            $data = $request->all();
            $id = $property->id;
            $propertyInfo = $this->updateProperty->updatePropertyInfo($data , $id);
            return $propertyInfo;
            $addressInfo = $this->updateProperty->updateAddressInfo($data , $id);
            $addressAdditionalInfo = $this->updateProperty->updateAddressAdditionalInfo($data , $addressInfo->id);
            $assignmentInfo = $this->updateProperty->updateAssignmentInfo($data , $id);
            $basicProperties = $this->updateProperty->updateBasicProperties($data , $id);
            $propertyDetail = $this->updateProperty->updatePropertyDetail($data , $id);
            $propertyCondition = $this->updateProperty->updatePropertyCondition($data , $id);
            $pricing = $this->updateProperty->updatePricing($data , $id);
            $utilities = $this->updateProperty->updateUtilities($data , $id);
            $parcels = $this->updateProperty->updateParcels($data , $id);
            $buildings = $this->updateProperty->updateBuildings($data , $id);
            $structures = $this->updateProperty->updateStructures($data , $id);
            $documentation = $this->updateProperty->updateDocumentation($data , $id);

            $properties = [
                $propertyInfo , $addressInfo , $addressAdditionalInfo , $assignmentInfo,
                $basicProperties , $buildings , $structures , $documentation , $parcels , 
                $propertyDetail , $propertyCondition ,$pricing , $utilities 
            ];
            return self::jsonSuccess('Property created successfully.', $properties, 200);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
   
}
