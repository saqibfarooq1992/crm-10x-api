<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Services\PropertyServices;
use App\Traits\Jsonify;

class PropertyController extends Controller
{
    use Jsonify;
    private $propertyServices;
    public function __construct(PropertyServices $propertyServices)
    {
        parent::__permissions('properties');
        $this->propertyServices = $propertyServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->propertyServices->search();
            return self::jsonSuccess('Properties retrieved successfully.',$data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $this->propertyServices->create($request);
            return self::jsonSuccess('Property created successfully.',$data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $propery)
    {
        try {
            $data = $this->propertyServices->show($propery);
            return self::jsonSuccess('Property retrieved successfully.',$data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $propery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        try {
            $data = $this->propertyServices->update($request, $property);
            return self::jsonSuccess('Property updated successfully.',$data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $propery)
    {
        try {
            $data = $this->propertyServices->delete($propery->id);
            return self::jsonSuccess('Property deleted successfully.',$data, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
