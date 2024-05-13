<?php

namespace App\Services;

use App\Helpers\GlobalHelper;
use App\Http\Resources\Collections\UsersCollection;
use App\Http\Resources\Permissions\UserResource;
use App\Mail\WelcomeToNewUser;
use App\Models\User;
use App\Traits\Jsonify;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserServices
{
    use Jsonify; // use this trait for json message and data
    private $model;
    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function search()
    {
        try {
            $user = auth()->user();
            $query = $user->hasRole('admin') 
                ? $this->model->with(['roles.permissions'])
                : $this->model->with(['roles.permissions']);

            //Skip the currently logged-in user's record
            $query->where('id', '!=', $user->id);
            return self::jsonSuccess('Users retrieved successfully.', new UsersCollection($query->get()), 200);

        } catch (Exception $exception) {
            return self::jsonError($exception->getMessage());
        }
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            // Create new user
            $user = $this->model->create([
                'f_name' => $request->f_name,
                'm_name' => $request->m_name,
                'l_name' => $request->l_name,
                'n_name' => $request->n_name,
                'title' => $request->title,
                'd_o_b' => $request->d_o_b,
                'state_of_license' => $request->state_of_license,
                'state_license_number' => $request->state_license_number,
                'industry_recognized_memberships' => $request->industry_recognized_memberships,
                'industry_recognized_designations' => $request->industry_recognized_designations,
                'cell_phone'    => $request->cell_phone,
                'website' => $request->website,
                'is_verified' => "un-verified",
                'is_two_factor' => "disabled",
                'in_business_since_year' => $request->in_business_since_year,
                'speciality' => $request->speciality,
                'profile_description' => $request->profile_description,
                'email' => $request->email,
                'password' => Hash::make($request->input('password')),
            ]);

            if ($user->save()) {
                $userData = [
                    'email'     => $user->email,
                    'full_name' => $user->f_name,
                ];
    
                try {
                    Mail::to($user->email)
                    ->send(new WelcomeToNewUser($userData));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    return response()->json([
                        'message'     => 'Some error occurred, please try again',
                        'status_code' => 500,
                    ], 500);
                }
    
                return response()->json([
                    'message'     => 'You are successfully create a new user account.',
                    'user_id' => $user,
                    'status_code' => 200,
                ], 200);
            } else {
                return response()->json([
                    'message'     => 'Some error occurred, please try again',
                    'status_code' => 500,
                ], 500);
            }

            // Check if roles are provided in the request
            if ($request->has('roles')) {
                // Ensure roles exist and convert them to an array
                $roles = is_array($request->roles) ? $request->roles : [$request->roles];
                
                // Assign roles to the user
                foreach ($roles as $roleId) {
                    $role = Role::findOrFail($roleId);
                    $user->assignRole($role);
                }
            }
            DB::commit();   
            return self::jsonSuccess("User created successfully",new UserResource($user->load('roles.permissions')), 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
                'status_code' => $exception->getCode(),
            ], 500);
        }
    }

    public function update($request , $user)
    {
        DB::beginTransaction();
        try {
            $data = $user;
            $data->f_name = $request->f_name;
            $data->m_name = $request->m_name;
            $data->l_name = $request->l_name;
            $data->n_name = $request->n_name;
            $data->title = $request->title;
            $data->d_o_b = $request->d_o_b;
            $data->state_of_license = $request->state_of_license;
            $data->state_license_number = $request->state_license_number;
            $data->industry_recognized_memberships = $request->industry_recognized_memberships;
            $data->industry_recognized_designations = $request->industry_recognized_designations;
            $data->cell_phone = $request->cell_phone;
            $data->website = $request->website;
            $data->in_business_since_year = $request->in_business_since_year;
            $data->speciality = $request->speciality;
            $data->profile_description = $request->profile_description;
            if ($request->has('password')) {
                $data->password = bcrypt($request->password);
            }
            $data->save();

            // Check if roles are provided in the request
            if ($request->has('roles')) {
                $roles = $request->input('roles', []);

                // Find the roles by their IDs
                $roles = Role::find($roles);

                // Check if roles are found
                if ($roles) {
                    // Sync the roles for the user
                    $user->syncRoles($roles);
                }
            }

            // Reload the user with updated roles and permissions
            $data->load('roles.permissions');
            DB::commit(); 
            return self::jsonSuccess('User updated successfully!', $data);
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }
    }

}
