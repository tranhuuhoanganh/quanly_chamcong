<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $primaryKey = 'type_id';

    protected $fillable = [
        'type_name',
        'description'
    ];

    public function leaveRequests()
    {
        return $this->hasMany(
            LeaveRequest::class,
            'type_id',
            'type_id'
        );
    }
}