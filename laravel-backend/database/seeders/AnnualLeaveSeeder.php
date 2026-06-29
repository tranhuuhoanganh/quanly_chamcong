<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AnnualLeave;

class AnnualLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = now()->year;

        foreach (User::all() as $user) {

            AnnualLeave::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'year' => $year,
                ],
                [
                    'annual_leave_number' => 12,
                    'ot_converted_number' => 0,
                ]
            );
        }
    }
}