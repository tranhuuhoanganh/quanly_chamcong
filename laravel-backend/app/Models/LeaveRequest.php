<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $primaryKey = 'request_id';

    public $timestamps = false;

    protected $fillable = [
        'start_date',
        'end_date',
        'sum_days',
        'hours',
        'content',
        'status_request',
        'create_date',
        'type_id',
        'user_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'create_date'=> 'datetime',
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class,'type_id','type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
}