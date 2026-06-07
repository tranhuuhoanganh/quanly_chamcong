<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function getRole()
    {
        return response()->json(Role::all());
    }
    
    public function createRole(Request $request){
        try {
            $role = Role::create([
                'role_name' => $request->role_name,
                'role_description' =>$request->role_description,
            ]);
            return response()->json(['role'=>$role, 'message'=>'create role successfully.'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Lỗi.',$e -> getMessage()],422); 
        }
    }
    public function deleteRole($id){
        $role = Role::find($id);
        if(!$role){
            return response()->json(['message'=>'role not found'],422);
        }
        $role->delete();
        return response()->json(['message'=>'Delete Role'],202);
    }
    public function updateRole(Request $request,$id){
        $role = Role::find($id);
        try {
            $role->update([
                'role_name' => $request->role_name,
                'role_description' =>$request->role_description,
            ]);
            return response()->json([ 'message'=>'edit role successfully.'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Lỗi.',$e -> getMessage()],422); 
        }
    }

}
