<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotpasswordController extends Controller
{
    public function store(Request $request)
    {
        try {
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::send('email.forgotPassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Reset Password');
            });

            return response()->json([
                'token' => $token,
                'message' => 'Gửi mail thành công',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Gửi mail thất bại',
                'error' => $e->getMessage(),
            ], 422);
        }

    }
}
