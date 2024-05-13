<?php

namespace App\Services;

use App\Http\Resources\Collections\RoleCollection;
use App\Http\Resources\Permissions\RoleResource;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Traits\Jsonify;
use Exception;
class RoleServices
{
    use Jsonify;
    private $model;
    
    /**
     * Create a new class instance.
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    public function search()
    {
        try {
            // Get the authenticated user
        $user = Auth::user();
        // Check if the user is authenticated
        if ($user) {
            // Check if the user has the 'admin' role
            if ($user->hasRole('admin')) {
                // Retrieve all roles
                $roles = Role::with('permissions')->get();
            } else {
                // Retrieve roles created by the authenticated user
                $roles = $user->roles()->with('permissions')->get();
            }

            $data = (new RoleCollection($roles));
            return self::jsonSuccess('Roles retrieved successfully.',$data, 200);
        } else {
            // User is not authenticated, handle accordingly
            return self::jsonError('Unauthorized.', 401);
        }

        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }
}
