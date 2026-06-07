<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    protected $table = 'working_days';

    protected $primaryKey = 'day_id';

    protected $fillable = [
        'work_date',
        'checkin_time',
        'checkout_time',
        'type_id',
    ];

    public function Type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'type_id');
    }
}