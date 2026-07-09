<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Employee;

class GetEmployeeController extends Controller
{
    public function GetEmployee(){
        return response()->json(Employee::all());
    }
}
