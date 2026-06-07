<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'Employees';

    protected $primaryKey = 'id';

    protected $fillable = [
        'emp_code',
        'fullname',
        'birthday',
        'sex',
        'email',
        'password',
        'phone',
        'hire_date',
        'status',
        'manager_id',
        'depart_id',
        'pos_id',
        'role_id',
        'user_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'depart_id', 'depart_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'pos_id', 'pos_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function manager(){
        return $this->belongsTo(Employee::class,'manager_id','id');
    }
    public function subordinates()
    {
    return $this->hasMany(Employee::class,'manager_id','id');
    }
}
