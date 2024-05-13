<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\GlobalHelper;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsByRoutes = GlobalHelper::getPermissionsByRoutes();

        $guards = array_keys(config('auth.guards'));
        
        foreach ($guards as $key => $guard) {
            foreach ($permissionsByRoutes as $key => $permission) {
                if($guard == 'api')
                {
                    Permission::firstOrCreate([
                        'name' => $permission,
                        'guard_name' => $guard
                    ]);
                }
            }
        }
    }
}
