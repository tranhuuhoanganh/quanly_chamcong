<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $primaryKey = 'deduction_id';

    protected $fillable = [
        'user_id',
        'deduction_type_id',
        'amount',
        'reason',
        'deduction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'deduction_date' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deductionType()
    {
        return $this->belongsTo(DeductionType::class, 'deduction_type_id');
    }
}