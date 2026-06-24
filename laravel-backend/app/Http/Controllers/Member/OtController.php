<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ConfirmOt;
use App\Models\Employee;
use App\Models\Ot;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtController extends Controller
{
    public function getLoai(){
        return response()->json(Type::all());
    }
    public function getUser(Request $request)
    {
        $user = Employee::where('user_id', $request->user_id)->first();
        return response()->json($user);
    }
    public function getOt()
    {
        $OT = Ot::with('type:type_id,type_name')->where('status', 0)->get();
        return response()->json($OT);
    }
    public function approveLeave(Request $request)
    {
        $OT = Ot::find($request->ot_id);
        if (!$OT) {
            return response()->json(['message' => 'Không có OT'], 422);
        }
        try {
            $OT->update([
                'status' => 1
            ]);
            ConfirmOt::create([
                'sum_hours_cf' => $OT->sum_hours_ot,
                'reason' => $request->ghi_Chu,
                'cf_date' => Carbon::now(),
                'approve_id' => Auth::id(),
                'ot_id' => $request->ot_id,
            ]);
            // Mail::to($OT->employee->email)->send(new OtApproveMail($OT));

            return response()->json(['message' => 'Duyệt nghỉ phép thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Duyệt nghỉ phép thất bại!', $e->getMessage()], 500);
        }
    }

    public function rejectLeave(Request $request)
    {
        $OT = Ot::find($request->request_id);
        if (!$OT) {
            return response()->json(['message' => 'Không có Leave'], 422);
        }
        try {

            $OT->update([
                'status_request' => 2
            ]);
            ConfirmOt::create([
                'sum_hours_cf' => $OT->sum_hours_ot,
                'reason' => $request->ghi_Chu,
                'cf_date' => Carbon::now(),
                'approve_id' => Auth::id(),
                'ot_id' => $request->ot_id,
            ]);
            // Mail::to($OT->employee->email)->send(new OtRejectedMail($OT));

            return response()->json(['message' => 'Từ chối nghỉ phép thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Từ chối nghỉ phép thất bại!', $e->getMessage()], 500);
        }
    }
}
