<?php

namespace Database\Seeders;

use App\Models\TimeEntry;
use Illuminate\Database\Seeder;

class TimeEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimeEntry::create([
            'user_id' => 1,
            'checkin_date' => now()->format('Y-m-d'),

            'checkin_time' => '08:37:00',
            'checkout_time' => '17:31:00',

            'number_minutes_late' => 37,
            'number_minutes_quit_early' => 29,
        ]);

        TimeEntry::create([
            'user_id' => 2,
            'checkin_date' => now()->subDay()->format('Y-m-d'),

            'checkin_time' => '08:05:00',
            'checkout_time' => '17:45:00',

            'number_minutes_late' => 5,
            'number_minutes_quit_early' => 0,
        ]);

        TimeEntry::create([
            'user_id' => 3,
            'checkin_date' => now()->subDays(2)->format('Y-m-d'),

            'checkin_time' => '07:55:00',
            'checkout_time' => '16:40:00',

            'number_minutes_late' => 0,
            'number_minutes_quit_early' => 20,
        ]);
    }
}