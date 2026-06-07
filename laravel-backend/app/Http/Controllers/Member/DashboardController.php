<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function countUser()
    {
        return User::count();
    }

}

