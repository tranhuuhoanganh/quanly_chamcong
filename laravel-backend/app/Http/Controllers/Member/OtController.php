<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\AnnualLeave;
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
    public function getLoai()
    {
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
    public function getotUser()
    {
        $phepOt = AnnualLeave::where('user_id', Auth::id())
            ->where('year', now()->year)
            ->value('ot_converted_number');
        $chuaDuyet = Ot::where([
            ['user_id', Auth::id()],
            ['status', 0],
        ])->count();
        $daDuyet = Ot::where([
            ['user_id', Auth::id()],
            ['status', 1],
        ])->count();
        $tuChoi = Ot::where([
            ['user_id', Auth::id()],
            ['status', 2],
        ])->count();
        $OT = Ot::with('type:type_id,type_name')->where('user_id', Auth::id())->get();
        return response()->json([
            'phepOt' => $phepOt,
            'chuaDuyet' => $chuaDuyet,
            'daDuyet' => $daDuyet,
            'tuChoi' => $tuChoi,
            'Ot' => $OT,
        ]);
    }
    public function approveOt(Request $request)
    {
        $OT = Ot::find($request->ot_id);
        if (!$OT) {
            return response()->json(['message' => 'Không có OT'], 422);
        }
        try {
            $annualLeave = AnnualLeave::where('user_id', $OT->user_id)
                ->where('year', now()->year)
                ->first();

            if ($annualLeave) {

                // Tổng giờ OT sau khi duyệt
                $totalHours = $annualLeave->ot_converted_number + $OT->sum_hours_ot;

                // Số ngày phép được cộng thêm
                $leaveDays = floor($totalHours / 8);

                // Giờ OT còn dư
                $remainingHours = $totalHours % 8;

                $annualLeave->update([
                    'annual_leave_number' => $annualLeave->annual_leave_number + $leaveDays,
                    'ot_converted_number' => $remainingHours,
                ]);
            }
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

    public function rejectOt(Request $request)
    {
        $OT = Ot::find($request->ot_id);
        if (!$OT) {
            return response()->json(['message' => 'Không có OT'], 422);
        }
        try {

            $OT->update([
                'status' => 2
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
    public function editOt(Request $request, $id)
    {
        $OT = Ot::find($id);
        if (!$OT) {
            return response()->json(['message' => 'Không có OT'], 422);
        }
        try {
            $OT->update([
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'reason' => $request->reason,
            ]);
            return response()->json(['message' => 'Bạn đã sửa phép OT thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Bạn đã sửa phép OT thất bại!', $e->getMessage()], 500);
        }
    }
}
