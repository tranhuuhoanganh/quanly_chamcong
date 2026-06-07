<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\TimeEntry;
use App\Models\WorkingDay;
use Illuminate\Http\Request;

class WorkingDayController extends Controller
{
    public function getWorkingDay()
    {
        $WorkingDay = WorkingDay::with(['Type:type_id,type_name'])->get();
        return response()->json($WorkingDay);
    }
    public function createWorkingDay(Request $request)
    {
        try {
            $WorkingDay = WorkingDay::create([
                'work_date' => $request->work_date,
                'checkin_time'=> $request->checkin_time,
                'checkout_time' => $request->checkout_time,
                'type_id' => $request->day_type,
            ]);
            return response()->json(['Working Day'=>$WorkingDay,'message'=>'Create Working Day suss'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Lỗi create Working Day', $e->getMessage()],422);
        }
    }

    public function deleteWorkingDay($id){
        $WorkingDay = WorkingDay::find($id);
        if (!$WorkingDay) {
            return response()->json(['message'=>'Working not defound'],422);
        }
        $WorkingDay->delete();
        return response()->json(['message'=>'Delete Working Day suss'],202);
    }
    public function updateWorkingDay(Request $request,$id)
    {
        $WorkingDay = WorkingDay::find($id);
        if (!$WorkingDay) {
            return response()->json(['message'=>'Working not defound'],422);
        }
        try {
            $WorkingDay->update([
                'work_date' => $request->work_date,
                'checkin_time'=> $request->checkin_time,
                'checkout_time' => $request->checkout_time,
                'type_id' => $request->day_type,
            ]);
            $time_entry = TimeEntry::where('checkin_date', $WorkingDay->day_id)->get();
            foreach ($time_entry as $item) {
                $item->update([
                    'checkin_time' => $request->checkin_time,
                    'checkout_time' => $request->checkout_time,
                ]);
            }
            return response()->json(['message'=>'Update Working Day suss'],200);
        } catch (\Throwable $e) {
            return response()->json(['message'=>'Lỗi update Working Day', $e->getMessage()],422);
        }
    }
}
