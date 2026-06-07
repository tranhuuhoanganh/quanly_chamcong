<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkingDay;

class WorkingDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkingDay::insert([
            [
                'work_date' => '2026-05-19',
                'checkin_time' => '08:00:00',
                'checkout_time' => '17:00:00',
                'type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'work_date' => '2026-05-20',
                'checkin_time' => '08:00:00',
                'checkout_time' => '17:00:00',
                'type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'work_date' => '2026-05-24',
                'checkin_time' => '08:00:00',
                'checkout_time' => '12:00:00',
                'type_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}