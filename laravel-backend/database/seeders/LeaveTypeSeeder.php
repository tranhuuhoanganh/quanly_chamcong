<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('leave_types')->insert([
            [
                'type_name' => 'Nghỉ phép năm',
                'description' => 'Nghỉ phép hưởng lương',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ phép bù',
                'description' => 'Nghỉ phép hưởng lương',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ ốm',
                'description' => 'Nghỉ do bệnh tật',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ không lương',
                'description' => 'Nghỉ không hưởng lương',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ kết hôn',
                'description' => 'Nghỉ có hưởng lương',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ phép học tập, đào tạo',
                'description' => 'Nghỉ phép do công ty cử đi đào tạo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ thai sản',
                'description' => 'Nghỉ thai sản theo quy định',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Nghỉ việc riêng',
                'description' => 'Nghỉ giải quyết việc cá nhân',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}