<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceCheck extends Model
{
    protected $table = 'attendance_check';

    protected $primaryKey = 'check_id';

    protected $fillable = [
        'time_entry_id',
        'is_late',
        'is_quit_early',
        'confirm_late',
        'confirm_early'
    ];

    public function timeEntry()
    {
        return $this->belongsTo(TimeEntry::class, 'time_entry_id', 'time_entry_id');
    }
}
