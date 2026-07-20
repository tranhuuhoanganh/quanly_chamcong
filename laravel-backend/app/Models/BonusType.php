<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonusType extends Model
{
    protected $table = 'bonus_types';

    protected $primaryKey = 'bonus_type_id';

    protected $fillable = [
        'bonus_type_name',
        'description',
    ];

    public function bonuses()
    {
        return $this->hasMany(Bonus::class, 'bonus_type_id', 'bonus_type_id');
    }
}