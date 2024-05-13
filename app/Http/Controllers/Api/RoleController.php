<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Jsonify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Collections\RoleCollection;
use App\Http\Resources\Permissions\RoleResource;
use App\Services\RoleServices;
use Exception;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use Jsonify;
    private $roleServices; 
    public function __construct(RoleServices $roleServices)
    {
        parent::__permissions('roles');
        $this->roleServices = $roleServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = $this->roleServices->search();
        return $role;
       
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
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'api'
            ]);

            if ($request->has('permissions')) {
                $permissions = $request->permissions;
                $permissions = json_decode($request->permissions, true);
                // Check if $permissions is already an array
                if (!is_array($permissions)) {
                    // Explode the string of comma-separated IDs into an array
                    $permissions = explode(',', $permissions);
                }
                    // Ensure permissions exist and convert them to an array
                    $permissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();

                    // Sync the permissions with the role
                    $role->syncPermissions($permissions);
            }

            return self::jsonSuccess(message: 'Role saved successfully!', data: $role);
        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $roles = Role::with('permissions')->find($id);
            return self::jsonSuccess(message: 'Roles retrieved successfully.', data: $roles, code: 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            $role->update([
                'name' => $request['name'],
                'guard_name' => 'api'
            ]);
    
            if ($request->has('permissions')) {
                // Decode the JSON array into a PHP array
                $permissions = json_decode($request->permissions, true);
    
                // Ensure permissions is an array
                if (!is_array($permissions)) {
                    throw new Exception('Invalid permissions format');
                }
    
                // Ensure permissions exist and convert them to an array of IDs
                $permissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();
    
                // Sync the permissions with the role
                $role->syncPermissions($permissions);
            }
    
            return self::jsonSuccess(data: $role->load('permissions'), message: 'Role updated successfully.');
        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->syncPermissions();

        $role->delete();

        return self::jsonSuccess(message: 'Role deleted successfully.');
    }
}
