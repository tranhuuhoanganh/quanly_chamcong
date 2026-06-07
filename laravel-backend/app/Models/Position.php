<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'Positions';

    protected $primaryKey = 'pos_id';

    protected $fillable = [
        'pos_code',
        'pos_name',
        'pos_description',
        'level',
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class, 'pos_id', 'pos_id');
    }

}
