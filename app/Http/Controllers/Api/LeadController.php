<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\LeadServices;
use App\Traits\Jsonify;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    use Jsonify;
    private $leadServices;
    public function __construct(LeadServices $leadServices)
    {
        parent::__permissions('contacts');
        $this->leadServices = $leadServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->leadServices->search();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $this->leadServices->create($request);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        try {
            $data = $this->leadServices->show($lead);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        try {
            $data = $this->leadServices->update($request, $lead);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        try {
            $data = $this->leadServices->delete($lead);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
