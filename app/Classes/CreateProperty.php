<?php

namespace App\Classes;

use App\Traits\Jsonify;
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
class CreateProperty
{
    use Jsonify;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function propertyInfo($data)
    {
        try {
            $propertyInfo = Property::create([
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
            ]);

            return $propertyInfo;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function addressInfo($data , $id)
    {
        try {
            $addressInfo = AddressInformation::create([
                'property_id' => $id, // Replace $propertyId with the actual ID of the property
                'country' => $data['country'],
                'state' => $data['state'],
                'county' => $data['county'],
                'township' => $data['township'],
                'subdivision' => $data['subdivision'],
                'has_parcel' => $data['has_parcel'] ? 1 : 0,
                'additional_buildings/structures' => $data['additional_buildings'],
                'street' => $data['street'],
                'second_street' => $data['second_street'],
                'city' => $data['city'],
                'zip_code' => $data['zip_code'],
            ]);
            return $addressInfo;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function addressAdditionalInfo($data , $addressId)
    {
        try {
            $addressAdditionalInfo = AddressAdditionalInformation::create([
                'address_id' => $addressId,
                'property_images' => $data['property_images'],
                'APN_State' => $data['APN_State'] ?? null,
                'legal_description' => $data['legal_description'] ?? null,
                'gis_url' => $data['gis_url'] ?? null,
                'google_map_url' => $data['google_map_url'] ?? null,
            ]);
            return $addressAdditionalInfo;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function assignmentInfo($data , $id)
    {
        try {
            $assignmentInfo =AssignmentInformation::create([
            'property_id' => $id,
            'assignment_title' => json_encode($data['assignment_title']),
            'assignment_name' => json_encode($data['assignment_name']),
            'assignment_email' => json_encode($data['assignment_email']),
            'assignment_phone' => json_encode($data['assignment_phone']),
            'assign_signs' => $data['assign_signs'],
            'assign_lockbox' => $data['assign_lockbox'],
            'assign_header' => $data['assign_header'],
            'assign_banner' => $data['assign_banner'],
            ]);
            return $assignmentInfo;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function basicProperties($data , $id)
    {
        try {
            $basicProperties = BasicPropertyInformation::create([
                'property_id' => $id,
                'total_square_footage_of_primary_home' => $data['total_square_footage_of_primary_home'],
                'acreage_of_primary_property' => $data['acreage_of_primary_property'],
                'architectural_style' => $data['architectural_style'],
                'year_build' => $data['year_build'],
                'number_of_bedrooms' => $data['number_of_bedrooms'],
                'number_of_full_bathrooms' => $data['number_of_full_bathrooms'],
                'number_of_half_bathrooms' => $data['number_of_half_bathrooms'],
                'levels' => $data['levels'],
                'foundation' => $data['foundation'],
                'waterfront' => $data['waterfront'],
                'is_property_part_of_HOA' => $data['is_property_part_of_HOA'] ? 1 : 0,
                'assign_HOA' => $data['assign_HOA']? 1 : 0,
                'attach_PDF_HOA_documents' => $data['attach_PDF_HOA_documents']? 1 : 0,
            ]);
            return $basicProperties;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function propertyDetail($data , $id)
    {
        try {
            $propertyDetail = PropertyDetail::create([
            'property_id' => $id,
            'unfinished' => $data['unfinished'] ? 1 : 0,
            'finished_basement' => $data['finished_basement'] ? 1 : 0,
            'fireplace' => $data['fireplace'] ? 1 : 0,
            'fence' => $data['fence'] ? 1 : 0,
            'deck' => $data['deck'] ? 1 : 0,
            'pool_spa' => $data['pool_spa']? 1 : 0,
            'property_floodzone_insured' => $data['property_floodzone_insured']? 1 : 0,
            'property_floodzone_not_insured' => $data['property_floodzone_not_insured']? 1 : 0,
            'property_divisible' => $data['property_divisible'],
            'age_of_furnace' => $data['age_of_furnace'],
            'type_of_furnace' => $data['type_of_furnace'],
            'water_heater_gas' => $data['water_heater_gas']? 1 : 0,
            'water_heater_electric' => $data['water_heater_electric']? 1 : 0,
            'water_heater_none' => $data['water_heater_none']? 1 : 0,
            'does_air_conditioner' => $data['does_air_conditioner']? 1 : 0,
            'type_of_air_conditioner' => json_encode($data['type_of_air_conditioner']),
            'number_of_units' => $data['number_of_units'],
            'air_conditioner_notes' => $data['air_conditioner_notes'],
            'water_conditioner_hookup' => $data['water_conditioner_hookup'],
            'water_conditioner_city' => $data['water_conditioner_city'],
            'water_conditioner_type' => $data['water_conditioner_type'],
            'water_conditioner_rented' => $data['water_conditioner_rented']? 1 : 0,
            'water_conditioner_purchased' => $data['water_conditioner_purchased']? 1 : 0,
            'water_conditioner_company' => $data['water_conditioner_company'],
            'water_conditioner_phone' => $data['water_conditioner_phone'],
            'water_conditioner_terms_contract' => $data['water_conditioner_terms_contract'],
            'age_of_roof' => $data['age_of_roof'],
            'roof_type' => json_encode($data['roof_type']),
            'multiple_layers' => $data['multiple_layers']? 1 : 0,
            'condition_of_roof' => $data['condition_of_roof']? 1 : 0,
            'how_many' => $data['how_many'],
            'roof_company_terms_contract' => $data['roof_company_terms_contract'],
            'parking_garage' => $data['parking_garage'],
            'parking_spaces' => $data['parking_spaces'],
            'garage_dimensions' => json_encode($data['garage_dimensions']),
            'appliances' => json_encode($data['appliances']),
            'appliances_included_in_sale' => $data['appliances_included_in_sale']? 1 : 0,
            'amenities' => json_encode($data['amenities'])
            ]);
            return $propertyDetail;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function propertyCondition($data , $id)
    {
        try {
            $propertyCondition = PropertyCondition::create([
                'property_id' => $id,
                'exterior_material' => $data['exterior_material'],
                'exterior_condition' => $data['exterior_condition'],
                'roof_age' => $data['roof_age'],
                'roof_condition' => $data['roof_condition'],
                'multiple_layers' => $data['multiple_layers'] ? 1 : 0,
                'interior_condition_overall' => $data['interior_condition_overall'],
                'mechanicals' => $data['mechanicals'],
                'water_softener' => $data['water_softener'] ? 1 : 0,
                'hot_water_tank' => $data['hot_water_tank'] ? 1 : 0,
                'hot_water_tank_age' => $data['hot_water_tank_age'],
                'appliance_quality' => $data['appliance_quality'],
                'kitchen_quality' => $data['kitchen_quality'],
                'lot_condition' => $data['lot_condition'],
                'flooring_condition' => $data['flooring_condition'],
                'fixtures_quality' => $data['fixtures_quality']
            ]);
            return $propertyCondition;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function pricing($data , $id)
    {
        try {
            $pricing = Pricing::create([
                'property_id' => $id,
                'property_value_as_is_condition' => $data['property_value_as_is'],
                'property_value_arv_standard' => $data['property_value_arv_standard'],
                'property_value_arv_premium' => $data['property_value_arv_premium'],
                'property_taxes_current' => $data['property_taxes_current'] ? 1 : 0,
                'mortgage_payments_current' => $data['mortgage_payments_current'] ? 1 : 0,
                'annual_taxes_for_primary_property' => $data['annual_taxes_for_primary_property'],
                'total_annual_taxes' => $data['total_annual_taxes'],
                'property_tax_card' => $data['property_tax_card'],
                'comps' => $data['comps'],
                'price_min' => $data['price_min'],
                'price_max' => $data['price_max'],
                'price_per_sqft' => $data['price_per_sqft'],
                'comp_document_uploaded' => $data['comp_document_uploaded'],
                'property_foreclosure_status' => $data['property_foreclosure_status'] ? 1 : 0,
                'pricing_property_condition' => $data['property_condition'],
            ]);
            return $pricing;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function utilities($data , $id)
    {
        try {
            $utilities = Utility::create([
                'property_id' => $id,
                'electrical_provider' => $data['electrical_provider'],
                'phone_number' => $data['phone_number'],
                'email' => $data['email'],
                'standard_single_phase_service' => $data['standard_single_phase_service']  ? 1 : 0,
                '230_volt_three_phase_power' => $data['230_volt_three_phase_power'] ? 1 : 0,
                '460_volt_three_phase_power' => $data['460_volt_three_phase_power']? 1 : 0,
                '575_volt_three_phase_power' => $data['575_volt_three_phase_power']? 1 : 0,
                'solar' => $data['solar'],
                'electric_generator' => $data['electric_generator'],
                'gas' => $data['gas']? 1 : 0,
                'propane_or_the_like' => $data['propane_or_the_like']? 1 : 0,
                'is_tank_rented' => $data['is_tank_rented'] ? 1 : 0,
                'no_gas' => $data['no_gas'] ? 1 : 0,
                'well' => $data['well'] ? 1 : 0,
                'city_water' => $data['city_water'] ? 1 : 0,
                'septic' => $data['septic'] ? 1 : 0,
                'sewer' => $data['sewer'] ? 1 : 0,
                'trash_cost_included_with_county_taxes' => $data['trash_cost_included_with_county_taxes'] ? 1 : 0,
                'trash_company_provider' => $data['trash_company_provider'],
                'trash_company_phone' => $data['trash_company_phone'],
                'gas_provider_name' => $data['gas_provider_name'],
                'gas_provider_phone' => $data['gas_provider_phone'],
                'propane_provider_name' => $data['propane_provider_name'],
                'propane_provider_phone' => $data['propane_provider_phone'],
                'water_provider_name' => $data['water_provider_name'],
                'water_provider_phone' => $data['water_provider_phone'],
                'sewer_company_name' => $data['sewer_company_name'],
                'sewer_company_phone' => $data['sewer_company_phone'],
            ]);
            return $utilities;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function parcels($data , $id)
    {
        try {
            $percels = Parcel::create([
                'property_id' => $id,
                'description' => $data['description'],
                'apn_no' => $data['apn_no'],
                'legal_description' => $data['legal_description'],
                'address' => $data['address'],
                'lot_size_acre' => $data['lot_size_acre'],
                'taxes' => $data['taxes'],
            ]);
            return $percels;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function buildings($data , $id)
    {
        try {
            $buildings = Building::create([
                'property_id' => $id,
                'description' => $data['description'],
                'same_parcel' => $data['same_parcel'] ? 1 : 0,
                'total_bedrooms' => $data['total_bedrooms'],
                'full_bathrooms' => $data['full_bathrooms'],
                'half_bathrooms' => $data['half_bathrooms'],
                'year_built' => $data['year_built'],
                'levels' => $data['levels'],
                'square_footage' => $data['square_footage'],
                'lot_size_sq_ft' => $data['lot_size_sq_ft'],
                'appliances' => $data['appliances'],
                'fireplace' => $data['fireplace'] ? 1 : 0,
                'garage' => $data['garage'] ? 1 : 0,
                'garage_spaces' => $data['garage_spaces'],
                'docs_and_pics' => $data['docs_and_pics'],
                'notes' => $data['notes'],
                'electrical' => $data['electrical'] ? 1 : 0,
                'water' => $data['water'] ? 1 : 0,
                'gas' => $data['gas'] ? 1 : 0,
                'bathroom' => $data['bathroom'] ? 1 : 0,
            ]);
            return $buildings;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function structures($data , $id)
    {
        try {
            $structures =OtherStructure::create([
                'property_id' => $id,
                'building_label' => $data['building_label'],
                'year_built' => $data['year_built'],
                'square_footage' => $data['square_footage'],
                'length' => $data['length'],
                'width' => $data['width'],
                'flood_zone' => $data['flood_zone'],
                'roof_type' => $data['roof_type'],
                'roof_condition' => $data['roof_condition'],
                'interior_material' => $data['interior_material'],
                'interior_condition' => $data['interior_condition'],
                'exterior_material' => $data['exterior_material'],
                'exterior_condition' => $data['exterior_condition'],
                'electricity_available' => $data['electricity_available'],
            ]);
            return $structures;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function documentation($data , $id)
    {
        try {
            $documentation = DocumentNoteAndRemark::create([
                'property_id' => $id,
                'building_layout_file' => $data['building_layout_file'],
                'environmental_reports_file' => $data['environmental_reports_file'],
                'inspection_reports_file' => $data['inspection_reports_file'],
                'traffic_count_file' => $data['traffic_count_file'],
                'offering_memorandum_file' => $data['offering_memorandum_file'],
                'notes' => $data['notes'],
                'effective_listing_date' => $data['effective_listing_date'],
                'expiration_date' => $data['expiration_date'],
                'days_required_to_list_by_mls' => $data['days_required_to_list_by_mls'],
                'public_remarks' => $data['public_remarks'],
                'private_remarks' => $data['private_remarks'],
            ]);
            return $documentation;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
