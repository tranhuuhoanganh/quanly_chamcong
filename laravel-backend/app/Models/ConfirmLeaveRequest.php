<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmLeaveRequest extends Model
{
    protected $table = 'Confirm_Leave_Request';

    protected $primaryKey = 'cf_request_id';

    protected $fillable = [
        'confirm_results',
        'approve_id',
        'request_id',
    ];

    public function leaveRequest()
    {
        return $this->belongsTo(
            Expalaination::class,
            'request_id',
            'request_id'
        );
    }
}