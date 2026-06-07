<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            Role::create([
                'role_name' => 'Admin',
                'role_description'=>'Quyền admin'
            ]);
    
            Role::create([
                'role_name' => 'Manager',
                'role_description'=>'Quyền Manager'
            ]);
            Role::create([
                'role_name' => 'Staff',
                'role_description'=>'Quyền Staff'
            ]);
            Role::create([
                'role_name' => 'User',
                'role_description'=>'Quyền user'
            ]);
        }
    }
}
