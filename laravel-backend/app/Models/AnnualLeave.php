<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnualLeave extends Model
{
    use HasFactory;

    protected $table = 'annual_leaves';

    protected $primaryKey = 'annual_leave_id';

    protected $fillable = [
        'user_id',
        'annual_leave_number',
        'ot_converted_number',
        'year',
    ];

    /**
     * Một bản ghi phép năm thuộc về một nhân viên.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}