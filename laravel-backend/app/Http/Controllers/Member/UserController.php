<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAccountInfo()
    {
        $user = Auth::user();
        return response()->json(['user'=>$user]);
    }
}
