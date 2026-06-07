<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function getPosition(){
        return response()->json(Position::all());
    }
    public function createPosition(Request $request){
        try {
            $pos= Position::create([
                'pos_code' => $request->pos_code,
                'pos_name' => $request->pos_name,
                'level' => $request->level,
                'pos_description' => $request->pos_description,
            ]);
            return response()->json(['pos'=>$pos,'message'=>'Create pos successfully'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Lỗi',$e->getMessage()],422);
        }
    }
    public function deletePosition($id){
        $pos = Position::find($id);
        if(!$pos){
            return response()->json(['message'=>'pos not found'],422);
        }
        $pos->delete();
        return response()->json(['message'=>'Delete pos successfully'],202); 
    }
    public function updatePosition(Request $request,$id){
        $pos = Position::find($id);
        if(!$pos){
            return response()->json([
                'message' => 'Position not found'
            ],404);
        }
        try {
            $pos->update([
                'pos_code' => $request->pos_code,
                'pos_name' => $request->pos_name,
                'level' => $request->level,
                'pos_description' => $request->pos_description,
            ]);
            return response()->json(['message'=>'Update pos successfully'],202); 
        } catch (\Throwable $e) {
            return response()->json([
                'message'=>'Lỗi',
                'error'=>$e->getMessage()
            ],422);
        }
    }
}
