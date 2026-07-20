<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploymentContracts extends Model
{

    protected $table = 'employment_contracts';

    protected $primaryKey = 'contract_id';

    protected $fillable = [
        'user_id',
        'contract_code',
        'sign_date',
        'start_date',
        'end_date',
        'basic_salary',
        'living_allowance',
        'position_allowance',
        'taxable_allowance',
        'participate_insurance',
        'is_current',
        'status',
    ];

    protected $casts = [
        'sign_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',

        'basic_salary' => 'decimal:2',
        'position_allowance' => 'decimal:2',
        'living_allowance' => 'decimal:2',
        'taxable_allowance' => 'decimal:2',

        'participate_insurance' => 'boolean',
        'is_current' => 'boolean',
    ];

    /**
     * Nhân viên sở hữu hợp đồng
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}