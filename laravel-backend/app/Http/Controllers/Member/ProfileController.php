<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        return response()->json($request->user());
    }

    public function updateProfile(Request $request){
        
        try {
            $user = Auth::User();
            $user->update([
                'email'=>$request->email,
                'name' => $request->name,
            ]);
            return response()->json(['user'=>$user, 'message'=>'update successfully'],200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'User not created',
                'error' => $e->getMessage()
            ], 422);
        }
    }
    

    public function changePassword(ChangePasswordRequest $request){
        try {
            
            $user = Auth::User();
            if(!Hash::check($request->password_old,$user->password)){
                return response()->json([
                    'errors' => [
                        'password_old' => ['Current password is incorrect']
                    ], 
                ], 422);
            };
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
            return response()->json(['message'=>'Password changed successfully'],200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Password changed is incorrect',
                'error' => $e->getMessage()
            ], 422);
        }
    }
}

