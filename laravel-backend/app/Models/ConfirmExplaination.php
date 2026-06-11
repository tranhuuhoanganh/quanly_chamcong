<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmExplaination extends Model
{
    protected $table = 'confirm_explaination';

    protected $primaryKey = 'cf_explain_id';

    protected $fillable = [
        'cf_date',
        'approve_id',
        'explain_id',
    ];

    public function expalaination()
    {
        return $this->belongsTo(
            Expalaination::class,
            'explain_id',
            'explain_id'
        );
    }
}