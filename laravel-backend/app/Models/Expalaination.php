<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expalaination extends Model
{
    protected $table = 'time_expalaination';

    protected $primaryKey = 'explain_id';

    protected $fillable = [
        'create_date',
        'reason',
        'type',
        'status',
        'time_entry_id'
    ];

    public function timeEntry()
    {   
        return $this->belongsTo(TimeEntry::class,'time_entry_id','time_entry_id');
    }
}