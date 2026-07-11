<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;

class GetUserController extends Controller
{
    public function GetUser(){
        $user = User::all();
        return response()->json($user);
    }
}
