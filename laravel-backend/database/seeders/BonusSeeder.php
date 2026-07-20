<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bonus;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bonuses = [
            [
                'user_id' => 1,
                'bonus_type_id' => 1,
                'amount' => 2000000,
                'bonus_date' => '2026-07-05',
                'payroll_month' => '2026-07',
                'reason' => 'Hoàn thành KPI tháng',
            ],
            [
                'user_id' => 2,
                'bonus_type_id' => 2,
                'amount' => 3500000,
                'bonus_date' => '2026-07-10',
                'payroll_month' => '2026-07',
                'reason' => 'Đạt doanh số vượt chỉ tiêu',
            ],
            [
                'user_id' => 3,
                'bonus_type_id' => 3,
                'amount' => 5000000,
                'bonus_date' => '2026-07-12',
                'payroll_month' => '2026-07',
                'reason' => 'Hoàn thành dự án đúng tiến độ',
            ],
            [
                'user_id' => 4,
                'bonus_type_id' => 4,
                'amount' => 1000000,
                'bonus_date' => '2026-09-02',
                'payroll_month' => '2026-09',
                'reason' => 'Thưởng Quốc khánh 2/9',
            ],
            [
                'user_id' => 5,
                'bonus_type_id' => 5,
                'amount' => 8000000,
                'bonus_date' => '2026-02-10',
                'payroll_month' => '2026-02',
                'reason' => 'Thưởng Tết Nguyên đán',
            ],
            [
                'user_id' => 1,
                'bonus_type_id' => 6,
                'amount' => 1500000,
                'bonus_date' => '2026-08-18',
                'payroll_month' => '2026-08',
                'reason' => 'Đề xuất sáng kiến cải tiến',
            ],
            [
                'user_id' => 2,
                'bonus_type_id' => 7,
                'amount' => 700000,
                'bonus_date' => '2026-08-25',
                'payroll_month' => '2026-08',
                'reason' => 'Thưởng khác',
            ],
        ];

        foreach ($bonuses as $bonus) {
            Bonus::create($bonus);
        }
    }
}