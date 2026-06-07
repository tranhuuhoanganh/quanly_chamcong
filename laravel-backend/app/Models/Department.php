<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $primaryKey = 'depart_id';

    protected $fillable = [
        'depart_code',
        'depart_name',
        'depart_description',
        'status',
        'manager_id'
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class, 'depart_id', 'depart_id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'id');
    }
}
