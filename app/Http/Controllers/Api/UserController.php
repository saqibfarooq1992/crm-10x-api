<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\Permissions\UserResource;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserServices;
use App\Traits\Jsonify;
use Exception;
class UserController extends Controller
{
    use Jsonify; // use this trait for json message and data
    private $userServices; 
    public function __construct(UserServices $userServices)
    {
        parent::__permissions('users');
        $this->userServices = $userServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->userServices->search(); 
        return $data;
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
            $user = $this->userServices->create($request);
             return $user;
         } catch (Exception $exception) {
             return self::jsonError($exception->getMessage());
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return self::jsonSuccess('Users retreived successfully.',new UserResource($user->load('roles.permissions')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $user = $this->userServices->update($request , $user);
             return $user;
        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $id = $user->id;
       
        $user = User::find($id);
            
        if ($user) {
            $user->syncRoles();
            $user->delete();
            return self::jsonSuccess('User deleted successfully.');
        } else {
            return self::jsonError('record not found.');
        }
    }
}
