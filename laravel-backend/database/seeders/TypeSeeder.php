<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::insert([
            [
                'type_name' => 'Weekday',
                'type_description' => 'Ngày làm việc bình thường',
                'ot_rate' => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Weekend',
                'type_description' => 'Ngày cuối tuần',
                'ot_rate' => 2.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Holiday',
                'type_description' => 'Ngày lễ',
                'ot_rate' => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}