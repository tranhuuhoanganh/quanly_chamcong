<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Expalaination;
use Illuminate\Http\Request;

class ExpalainationController extends Controller
{
    public function getExpalaination()
    {
        return response()->json(
            Expalaination::orderBy('explain_id', 'desc')->get()
        );
    }

    public function searchExpalaination(Request $request)
    {
        $date = $request->date;
        $expalainations = Expalaination::query();
        if (! empty($date)) {
            $expalainations->whereDate('create_date', $date);
        }
        return response()->json($expalainations->get());
    }
    public function updateExpalaination(Request $request,$id) {
        $expalaination = Expalaination::find($id);
        if(!$expalaination){
            return response()->json(['message'=>'Không có expalaination']);
        }
        $expalaination->update([
            'reason' => $request->reason,
            'type' => $request->type,
        ]);
        return response()->json(['message'=>'Bạn đã update expalaination thành công!']);
    }
    public function deleteExpalaination($id){
        $expalaination = Expalaination::find($id);
        if(!$expalaination){
            return response()->json(['message'=>'Không có expalaination']);
        }
        $expalaination->delete();
        return response()->json(['message'=>'Bạn đã xóa expalaination thành công!']);
    }
}
