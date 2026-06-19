<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLeaveRequest;
use App\Mail\LeaveApproveMail;
use App\Mail\LeaveRejectedMail;
use App\Models\ConfirmLeaveRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function Illuminate\Support\hours;

class LeaveRequestController extends Controller
{
    public function getLoai()
    {
        return response()->json(LeaveType::all());
    }
    public function createLeave(CreateLeaveRequest $request)
    {
        try {
            $start = Carbon::parse($request->tu_ngay);
            $end = Carbon::parse($request->den_ngay);

            $sum_days = $start->diffInDays($end) + 1;
            LeaveRequest::create([
                'start_date' => $request->tu_ngay,
                'end_date' => $request->den_ngay,
                'sum_days' => $sum_days,
                'hours' => $request->gio,
                'content' => $request->ly_do,
                'status_request' => 0,
                'create_date' => Carbon::now(),
                'type_id' => $request->loai_nghi,
                'user_id' => Auth::id(),
            ]);
            return response()->json(['message' => 'Tạo đơn xin nghỉ thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Tạo đơn xin nghỉ thất bại', $e->getMessage()], 422);
        }
    }
    public function getLeave()
    {
        $leave = LeaveRequest::with('leaveType:type_id,type_name')->where('status_request', 0)->orderBy('request_id', 'desc')->get();
        return response()->json($leave);
    }

    public function getUser(Request $request)
    {
        $user = Employee::where('user_id', $request->user_id)->first();
        return response()->json($user);
    }
    public function getLeaveUser()
    {
        $leave = LeaveRequest::with('leaveType:type_id,type_name')->where('user_id', Auth::id())->orderBy('request_id', 'desc')->get();
        return response()->json($leave);
    }
    public function approveLeave(Request $request)
    {
        $leaveRequest = LeaveRequest::find($request->request_id);
        if (!$leaveRequest) {
            return response()->json(['message' => 'Không có Leave'], 422);
        }
        try {
            $leaveRequest->update([
                'status_request' => 1
            ]);
            ConfirmLeaveRequest::create([
                'confirm_results' => 1,
                'approve_id' => Auth::id(),
                'request_id' => $request->request_id,
            ]);
            Mail::to($leaveRequest->employee->email)->send(new LeaveApproveMail($leaveRequest));

            return response()->json(['message' => 'Duyệt nghỉ phép thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Duyệt nghỉ phép thất bại!', $e->getMessage()], 500);
        }
    }

    public function rejectLeave(Request $request)
    {
        $leaveRequest = LeaveRequest::find($request->request_id);
        if (!$leaveRequest) {
            return response()->json(['message' => 'Không có Leave'], 422);
        }
        try {

            $leaveRequest->update([
                'status_request' => 2
            ]);
            ConfirmLeaveRequest::create([
                'confirm_results' => 2,
                'approve_id' => Auth::id(),
                'request_id' => $request->request_id,
            ]);
            Mail::to($leaveRequest->employee->email)->send(new LeaveRejectedMail($leaveRequest));
            return response()->json(['message' => 'Từ chối nghỉ phép thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Từ chối nghỉ phép thất bại!', $e->getMessage()], 500);
        }
    }
    public function editLeave(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::find($id);
        if (!$leaveRequest) {
            return response()->json(['message' => 'Không có Leave'], 422);
        }
        try {
            $start = Carbon::parse($request->tu_ngay);
            $end = Carbon::parse($request->den_ngay);

            $sum_days = $start->diffInDays($end) + 1;
            $leaveRequest->update([
                'start_date' => $request->tu_ngay,
                'end_date' => $request->den_ngay,
                'sum_days' => $sum_days,
                'hours' => $request->gio,
                'content' => $request->ly_do,
                'type_id' => $request->type_id,
            ]);

            return response()->json(['message' => 'Update thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Update thất bại!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
