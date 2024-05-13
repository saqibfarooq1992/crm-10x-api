<?php

namespace Database\Seeders;

use App\Enums\Permissions\RoleTypeEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agent = Role::firstOrCreate(['name' => RoleTypeEnum::AGENT]);
        $user = User::factory()->create([  
            'f_name' => 'User',
            'm_name' => 'Phillips',
            'l_name' => 'Johansson',
            'is_two_factor' => "disabled",
            'email' =>  "user@example.com",
        ])->assignRole($agent);
        
        $token = $user->createToken('auth')->plainTextToken;
    }
}
