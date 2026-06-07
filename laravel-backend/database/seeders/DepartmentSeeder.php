<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'depart_code' => 'IT',
                'depart_name' => 'Công nghệ thông tin',
                'depart_description' => 'Phòng IT',
                'status' => 1,
                'manager_id' => 1,
                'created_at' => now(),
'updated_at' => now(),
            ],
            [
                'depart_code' => 'HR',
                'depart_name' => 'Nhân sự',
                'depart_description' => 'Phòng nhân sự',
                'status' => 1,
                'manager_id' => 2,
                'created_at' => now(),
'updated_at' => now(),
            ],
            [
                'depart_code' => 'ACC',
                'depart_name' => 'Kế toán',
                'depart_description' => 'Phòng kế toán',
                'status' => 1,
                'manager_id' => 3,
                'created_at' => now(),
'updated_at' => now(),
            ],
        ]);
    }
    
}