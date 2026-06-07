<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'pos_code' => 'GD',
            'pos_name' => 'Giám đốc',
            'level' => 1,
            'pos_description' => 'Điều hành công ty'
        ]);
        Position::create([
            'pos_code' => 'QL',
            'pos_name' => 'Quản lý',
            'level' => 2,
            'pos_description' => 'Quản lý nhóm hoặc phòng ban'
        ]);
        Position::create([
            'pos_code' => 'NV',
            'pos_name' => 'Nhân viên',
            'level' => 3,
            'pos_description' => 'Nhân viên chính thức'
        ]);
        Position::create([
            'pos_code' => 'TTS',
            'pos_name' => 'Thực tập sinh',
            'level' => 3,
            'pos_description' => 'Học việc và hỗ trợ công việc'
        ]);

        Position::create([
            'pos_code' => 'CTV',
            'pos_name' => 'Cộng tác viên',
            'level' => 3,
            'pos_description' => 'Làm việc bán thời gian hoặc cộng tác'
        ]);

        

        

        
    }
}