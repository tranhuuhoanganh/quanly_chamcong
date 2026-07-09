<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;

class GetUserController extends Controller
{
    public function GetUser(){
        return response()->json(User::all());
    }
}
