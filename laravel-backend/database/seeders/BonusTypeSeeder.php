<?php

namespace Database\Seeders;

use App\Models\BonusType;
use Illuminate\Database\Seeder;

class BonusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bonusTypes = [
            [
                'bonus_type_name' => 'Thưởng KPI',
                'description' => 'Thưởng theo kết quả KPI.'
            ],
            [
                'bonus_type_name' => 'Thưởng doanh số',
                'description' => 'Thưởng theo doanh số đạt được.'
            ],
            [
                'bonus_type_name' => 'Thưởng dự án',
                'description' => 'Thưởng khi hoàn thành dự án.'
            ],
            [
                'bonus_type_name' => 'Thưởng lễ',
                'description' => 'Thưởng vào các dịp lễ.'
            ],
            [
                'bonus_type_name' => 'Thưởng Tết',
                'description' => 'Thưởng cuối năm hoặc dịp Tết.'
            ],
            [
                'bonus_type_name' => 'Thưởng sáng kiến',
                'description' => 'Thưởng cho sáng kiến, cải tiến.'
            ],
            [
                'bonus_type_name' => 'Thưởng khác',
                'description' => 'Các khoản thưởng khác.'
            ],
        ];

        foreach ($bonusTypes as $bonusType) {
            BonusType::updateOrCreate(
                ['bonus_type_name' => $bonusType['bonus_type_name']],
                $bonusType
            );
        }
    }
}