<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    protected $primaryKey = 'type_id';

    protected $fillable = [
        'type_name',
        'type_description',
        'ot_rate',

    ];
    public function WorkingDay()
    {
        return $this->hasMany(WorkingDay::class, 'type_id', 'type_id');
    }
}
