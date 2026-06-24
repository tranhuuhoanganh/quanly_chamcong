<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmOt extends Model
{
    protected $table = 'confirm_ot';

    protected $primaryKey = 'cf_ot_id';

    protected $fillable = [
        'sum_hours_ot',
        'cf_date',
        'reason',
        'approve_id',
        'ot_id',
    ];

    public function ot()
    {
        return $this->belongsTo(Ot::class, 'ot_id', 'ot_id');
    }
}