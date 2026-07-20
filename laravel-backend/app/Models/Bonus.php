<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonuses';

    protected $primaryKey = 'bonus_id';

    protected $fillable = [
        'user_id',
        'bonus_type_id',
        'amount',
        'payroll_month',
        'reason',
    ];

    protected $casts = [
        'bonus_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Người được thưởng
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Loại thưởng
     */
    public function bonusType()
    {
        return $this->belongsTo(BonusType::class, 'bonus_type_id', 'bonus_type_id');
    }
}