<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeductionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('deduction_types')->insert([
            [
                'name' => 'Tạm ứng lương',
                'description' => 'Khấu trừ số tiền nhân viên đã tạm ứng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bồi thường tài sản',
                'description' => 'Khấu trừ do làm hỏng hoặc làm mất tài sản công ty.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vi phạm nội quy',
                'description' => 'Khấu trừ theo quyết định xử lý vi phạm nội quy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khấu trừ khác',
                'description' => 'Các khoản khấu trừ ngoài các trường hợp trên.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}