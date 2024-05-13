<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Traits\Jsonify;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    use Jsonify;
    public function __construct()
    {
        parent::__permissions('socials');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Social::get();
                return self::jsonSuccess('Social links retrieved successfully.',$data, 200);
        } catch (\Throwable $th) {
            throw $th;
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
            $social = Social::create($request->all());
                return self::jsonSuccess('Social link created successfully.',$social, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
       try {
        //   $social = Social::find($id);
           return self::jsonSuccess('Social link retrieved successfully.',$social, 200);
       } catch (\Throwable $th) {
        //throw $th;
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Social $social)
    {
        try {
            $social->update($request->all());
                return self::jsonSuccess('Social link updated successfully.',$social, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        try {
            $social->delete();
                return self::jsonSuccess('Social link deleted successfully.');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
