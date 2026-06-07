<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetpasswordController extends Controller
{   
    
    public function store(Request $request) 
    {
        try {
            $updatePassword = DB::table('password_reset_tokens')->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();
            if (!$updatePassword) {
                return response()->json(['message'=>'Invalid token'],422);
            }
            User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            DB::table('password_reset_tokens')->where('email' ,$request->email)->delete();
            return response()->json([
                'message' => 'Password reset successfully'
            ],201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'User not created',
                'error' => $e->getMessage()
            ], 422);
        }
    }

   
}
