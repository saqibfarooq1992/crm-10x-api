<?php

namespace App\Services;

use App\Http\Resources\Collections\LeadCollection;
use App\Models\Lead;
use App\Models\LeadAssignment;
use App\Models\LeadOrganization;
use App\Models\LeadRequirement;
use App\Models\LeadVistedProperty;
use App\Traits\Jsonify;

class LeadServices
{
    use Jsonify;
    private $model;
    /**
     * Create a new class instance.
     */
    public function __construct(Lead $model)
    {
        $this->model = $model;
    }
    public function search()
    {
        try {
            $leads = $this->model->with('leadOrganization', 'leadAssignment', 'leadRequirement', 'leadVisitedProperty')->get();
            $data = (new LeadCollection($leads));
            return self::jsonSuccess('Leads retrieved successfully.',$data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function show($lead)
    {
        try {
            $leads = $this->model->with('leadOrganization', 'leadAssignment', 'leadRequirement', 'leadVisitedProperty')->find($lead);
            $data = (new LeadCollection($leads));
            return self::jsonSuccess('Leads retrieved successfully.',$data, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function create($request)
    {
        try {
            $leadData = (object) $request->all(); // Typecasting to object
            $leadInfo = $this->createLeadInfo($leadData);
            $leadOrganizations = $this->createLeadOrganizations($leadData, $leadInfo->id);
            $leadRequirement = $this->createLeadRequirement($leadData, $leadInfo->id);
            $leadAssignment = $this->createLeadAssignment($leadData, $leadInfo->id);
            $leadVisted = $this->createLeadVistedProperty($leadData, $leadInfo->id);

            $data = [$leadInfo, $leadOrganizations, $leadAssignment, $leadRequirement , $leadVisted];
            
            return response()->json(['message' => 'Lead created successfully', 'data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed to create lead', 'error' => $th->getMessage()], 500);
        }
    }
    public function createLeadInfo($leadData)
    {
        try {
            $leadInfo = Lead::create([
                'leadType' => $leadData->leadType,
                'f_name' => $leadData->f_name,
                'm_name' => $leadData->m_name,
                'l_name' => $leadData->l_name,
                'nick_name' => $leadData->nick_name,
                'company' => $leadData->company,
                'title' => $leadData->title,
                'email' => $leadData->email,
                'phone' => $leadData->phone,
                'additional_phone' => $leadData->additional_phone,
                'anyone_else_on_deed' => $leadData->anyone_else_on_deed,
                'lead_status' => $leadData->lead_status,
                'tags' => $leadData->tags,
                'lead_source' => $leadData->lead_source,
                'assigned_to' => $leadData->assigned_to,
                'property_type' => $leadData->property_type,
                'residential_type' => $leadData->residential_type,
                'commercial_type' => $leadData->commercial_type,
                'referral_name' => $leadData->referral_name,
                'referral_email' => $leadData->referral_email,
                'referral_number' => $leadData->referral_number,
                'country' => $leadData->country,
                'address' => $leadData->address,
                'state' => $leadData->state,
                'county' => $leadData->county,
                'city' => $leadData->city,
                'zip_code' => $leadData->zip_code,
                'township' => $leadData->township,
                'subdivision' => $leadData->subdivision,
            ]);
                return $leadInfo;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function createLeadOrganizations($leadData , $id)
    {
        try {
            $leadOrganization = LeadOrganization::create([
                        'lead_id' => $id,
                        'company_name' => $leadData->company_name, // Accessing properties directly
                        'sign_requirement' => $leadData->sign_requirement,
                        'organization_name' => $leadData->organization_name,
                        'organization_email' => $leadData->organization_email,
                        'organization_phone' => $leadData->organization_phone,
                        'organization_authorized_to_sign' => $leadData->organization_authorized_to_sign
                    ]);
                return $leadOrganization;
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
    }
    public function createLeadRequirement($leadData , $id)
    {
        try {
            $leadRequirment = LeadRequirement::create([
                'lead_id' => $id,
                'price_range_min' => $leadData->price_range_min,
                'price_range_max' => $leadData->price_range_max,
                'expected_listing_price' => $leadData->expected_listing_price,
                'square_footage' => $leadData->square_footage,
                'lot_size' => $leadData->lot_size,
                'property_details' => $leadData->property_details,
                'comps' => $leadData->comps,
                'seller_price_max' => $leadData->seller_price_max,
                'seller_price_min' => $leadData->seller_price_min,
                'price_per_sqrFT' => $leadData->price_per_sqrFT,
                'seller_comps_file' => $leadData->seller_comps_file,
                'desired_square_footage_min' => $leadData->desired_square_footage_min,
                'desired_square_footage_max' => $leadData->desired_square_footage_max,
                'desired_lot_size_min' => $leadData->desired_lot_size_min,
                'desired_lot_size_max' => $leadData->desired_lot_size_max,
                'is_investment' => $leadData->is_investment,
                'financing_cash' => $leadData->financing_cash,
                'pre_approved' => $leadData->pre_approved
            ]);
            return $leadRequirment;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function createLeadAssignment($leadData , $id)
    {
        try {
            $assignments = LeadAssignment::create([
                'lead_id' => $id,
                'assignment_title' => json_encode($leadData->assignment_title),
                'assignment_name' => json_encode($leadData->assignment_name),
                'assignment_email' => json_encode($leadData->assignment_email),
                'assignment_phone' => json_encode($leadData->assignment_phone),
                'assignment_notes' => json_encode($leadData->assignment_notes),
            ]);
            return $assignments;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function createLeadVistedProperty($leadData , $id)
    {
        try {
            $vistedProperty = LeadVistedProperty::create([
                                    'lead_id' => $id,
                                    'lead_property_visted_address' => json_encode($leadData->lead_property_visted_address),
                                    'lead_property_visted_price' => json_encode($leadData->lead_property_visted_price),
                                    'lead_property_visted_file' => json_encode($leadData->lead_property_visted_file),
                                    'lead_property_visted_notes' => json_encode($leadData->lead_property_visted_notes),
                                ]);
                                return $vistedProperty;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function update($request, $lead)
    {
        try {
            $leadData = (object) $request->all(); // Typecasting to object
            $leadInfo = $this->updateLeadInfo($leadData, $lead);
            $leadOrganizations = $this->updateLeadOrganizations($leadData, $lead);
            $leadRequirement = $this->updateLeadRequirement($leadData, $lead);
            $leadAssignment = $this->updateLeadAssignment($leadData, $lead);
            $leadVisted = $this->updateLeadVistedProperty($leadData, $lead);

            $data = [$leadInfo, $leadOrganizations, $leadAssignment, $leadRequirement , $leadVisted];
            
            return response()->json(['message' => 'Lead updated successfully', 'data' => $data], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    public function updateLeadInfo($leadData, $lead)
    {
        try {
            $lead->update([
                'leadType' => $leadData->leadType,
                'f_name' => $leadData->f_name,
                'm_name' => $leadData->m_name,
                'l_name' => $leadData->l_name,
                'nick_name' => $leadData->nick_name,
                'company' => $leadData->company,
                'title' => $leadData->title,
                'email' => $leadData->email,
                'phone' => $leadData->phone,
                'additional_phone' => $leadData->additional_phone,
                'anyone_else_on_deed' => $leadData->anyone_else_on_deed,
                'lead_status' => $leadData->lead_status,
                'tags' => json_encode($leadData->tags),
                'lead_source' => $leadData->lead_source,
                'assigned_to' => $leadData->assigned_to,
                'property_type' => $leadData->property_type,
                'residential_type' => $leadData->residential_type,
                'commercial_type' => $leadData->commercial_type,
                'referral_name' => $leadData->referral_name,
                'referral_email' => $leadData->referral_email,
                'referral_number' => $leadData->referral_number,
                'country' => $leadData->country,
                'address' => $leadData->address,
                'state' => $leadData->state,
                'county' => $leadData->county,
                'city' => $leadData->city,
                'zip_code' => $leadData->zip_code,
                'township' => $leadData->township,
                'subdivision' => $leadData->subdivision,
            ]);
            return $lead;

        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function updateLeadOrganizations($leadData, $lead)
    {
        try {
            $leadOrganization = $lead->leadOrganization()->first(); // Assuming lead has one lead organization
        if ($leadOrganization) {
            $leadOrganization->update([
                'company_name' => $leadData->company_name,
                'sign_requirement' => json_encode($leadData->sign_requirement),
                'organization_name' => json_encode($leadData->organization_name),
                'organization_email' => json_encode($leadData->organization_email),
                'organization_phone' => json_encode($leadData->organization_phone),
                'organization_authorized_to_sign' => json_encode($leadData->organization_authorized_to_sign),
            ]);
            return $leadOrganization;
        }
        return null; // Handle case where lead organization is not found
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function updateLeadRequirement($leadData, $lead)
    {
        try {
            $leadRequirement = $lead->leadRequirement()->first(); // Assuming lead has one lead requirement
        if ($leadRequirement) {
            $leadRequirement->update([
                'price_range_min' => $leadData->price_range_min,
                'price_range_max' => $leadData->price_range_max,
                'expected_listing_price' => $leadData->expected_listing_price,
                'square_footage' => $leadData->square_footage,
                'lot_size' => $leadData->lot_size,
                'property_details' => $leadData->property_details,
                'comps' => $leadData->comps,
                'seller_price_max' => $leadData->seller_price_max,
                'seller_price_min' => $leadData->seller_price_min,
                'price_per_sqrFT' => $leadData->price_per_sqrFT,
                'seller_comps_file' => $leadData->seller_comps_file,
                'desired_square_footage_min' => $leadData->desired_square_footage_min,
                'desired_square_footage_max' => $leadData->desired_square_footage_max,
                'desired_lot_size_min' => $leadData->desired_lot_size_min,
                'desired_lot_size_max' => $leadData->desired_lot_size_max,
                'is_investment' => $leadData->is_investment,
                'financing_cash' => $leadData->financing_cash,
                'pre_approved' => $leadData->pre_approved
            ]);
            return $leadRequirement;
        }
        return null; // Handle case where lead requirement is not found
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateLeadAssignment($leadData, $lead)
    {
        try {
            $leadAssignment = $lead->leadAssignment()->first(); // Assuming lead has one lead assignment
        if ($leadAssignment) {
            $leadAssignment->update([
                'assignment_title' => json_encode($leadData->assignment_title),
                'assignment_name' => json_encode($leadData->assignment_name),
                'assignment_email' => json_encode($leadData->assignment_email),
                'assignment_phone' => json_encode($leadData->assignment_phone),
                'assignment_notes' => json_encode($leadData->assignment_notes),
            ]);
            return $leadAssignment;
        }
        return null; // Handle case where lead assignment is not found
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updateLeadVistedProperty($leadData, $lead)
    {
        try {
            $leadVisitedProperty = $lead->leadVisitedProperty()->first(); // Assuming lead has one visited property
            if ($leadVisitedProperty) {
                $leadVisitedProperty->update([
                    'lead_property_visted_address' => json_encode($leadData->lead_property_visted_address),
                    'lead_property_visted_price' => json_encode($leadData->lead_property_visted_price),
                    'lead_property_visted_file' => json_encode($leadData->lead_property_visted_file),
                    'lead_property_visted_notes' => json_encode($leadData->lead_property_visted_notes),
                ]);
                return $leadVisitedProperty;
            }
            return null; // Handle case where visited property is not found 
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function delete($lead)
    {
        try {
            $lead->delete();
            return response()->json(['message' => 'Lead deleted successfully'],  200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
