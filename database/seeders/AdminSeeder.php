<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Enums\Permissions\RoleTypeEnum;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => RoleTypeEnum::ADMIN]);
        $user = User::factory()->create([  
            'f_name' => 'Admin',
            'm_name' => 'Doe',
            'l_name' => 'Smith',
            'is_verified' => 'verified',
            'is_two_factor' => "disabled",
            'email' =>  "moeez@nsolbpo.com",


        ])->assignRole($superAdmin);
        
        $token = $user->createToken('auth')->plainTextToken;
        dump("Super Admin Token : $token");
    }
    
}
