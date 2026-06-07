<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    protected $table = 'time_entry';

    protected $primaryKey = 'time_entry_id';

    protected $fillable = [
        'user_id',
        'checkin_date',
        'checkin_time',
        'checkout_time',
        'number_minutes_late',
        'number_minutes_quit_early',
    ];

    public function WorkingDay()
    {
        return $this->belongsTo(WorkingDay::class, 'checkin_date', 'day_id');
    }

    public function explanations()
    {
        return $this->hasMany(Explanation::class,'time_entry_id','time_entry_id');
    }
}
