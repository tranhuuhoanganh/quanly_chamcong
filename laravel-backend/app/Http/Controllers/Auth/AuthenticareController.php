<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticareController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (! Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Tài khoản hoặc mật khẩu không đúng',
                    'errors' => [
                        'email' => ['Tài khoản hoặc mật khẩu không đúng'],
                    ],
                ], 401);
            }
            $user = Auth::user();
            $token = $user->createToken('api token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'login successfully',
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'User not created',
                'error' => $e->getMessage(),
            ], 422);
        }

    }

    public function logout(Request $request){
        $request->User()->tokens()->delete();
        return response()->json([
            'message' => 'Logout successfully',
        ], 201);
    }
}
