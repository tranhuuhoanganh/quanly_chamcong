<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    protected $table = 'ot';
    protected $primaryKey = 'ot_id';

    protected $fillable = [
        'ot_date',
        'start_time',
        'end_time',
        'sum_hours_ot',
        'status',
        'reason',
        'type_id',
        'user_id',
    ];

    protected $casts = [
        'ot_date' => 'date',
        'sum_hours_ot' => 'decimal:2',
    ];
    /**
     * Người tạo đơn OT
     */
    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Loại OT
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'type_id');
    }
}
