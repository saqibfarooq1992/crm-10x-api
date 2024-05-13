<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Enums\Permissions\RoleTypeEnum;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = RoleTypeEnum::getValues();

        foreach ($roles as $role) Role::firstOrCreate(['name' => $role]);
    }
}
