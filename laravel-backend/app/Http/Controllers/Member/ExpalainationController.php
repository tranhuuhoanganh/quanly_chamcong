<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Expalaination;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpalainationController extends Controller
{
    public function getExpalaination()
    {
        $expalainations = Expalaination::with('timeEntry')
        ->whereRelation('timeEntry', 'user_id', Auth::id())
        ->orderBy('explain_id', 'desc')
        ->get();

        return response()->json($expalainations);
    }
    public function getUser(Request $request){
        $timeEntryId = $request->time_entry_id;

        $timeEntry = TimeEntry::where('time_entry_id',$timeEntryId)->first();
    
        $employee = Employee::where('user_id',$timeEntry->user_id)->first();
    
        return response()->json($employee);
    }
    public function getDetailExpalaination()
    {
        return response()->json(
            Expalaination::where('status',0)->orderBy('explain_id', 'desc')->get()
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
    public function searchDetailExpalaination(Request $request)
    {
        $date = $request->date;
        $expalainations = Expalaination::query();
        if (! empty($date)) {
            $expalainations->where('status',0)->whereDate('create_date', $date);
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
