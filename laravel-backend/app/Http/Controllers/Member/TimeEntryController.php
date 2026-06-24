<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\AttendanceCheck;
use App\Models\Expalaination;
use App\Models\Ot;
use App\Models\TimeEntry;
use App\Models\WorkingDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeEntryController extends Controller
{
    public function getWorkingDay()
    {
        $workingDay = WorkingDay::whereDate('work_date', today())->first();
        if (! $workingDay) {
            return response()->json([
                'message' => 'Hôm nay không có lịch làm việc',
            ], 404);
        }

        return response()->json($workingDay, 200);
    }

    public function CreateCheckin(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            // Giờ quy định
            $work_start = Carbon::parse($request->checkin_time);
            // Giờ thực tế
            $actual_checkin = Carbon::now();

            // Tính số phút đi muộn
            $number_minutes_late = 0;
            $is_late = 0;
            if ($actual_checkin->gt($work_start)) {
                $number_minutes_late = $work_start->diffInMinutes($actual_checkin);
                $is_late = '1';
            }

            // Chưa checkout nên mặc định = 0
            $number_minutes_quit_early = 0;

            $timeEntry = TimeEntry::where(['user_id' => $user_id, 'checkin_date' => $request->day_id])->first();
            if ($timeEntry && $timeEntry->checkin_time) {
                return response()->json([
                    'message' => 'Bạn đã check in rồi',
                ], 400);
            }
            $checkin = TimeEntry::create([
                'user_id' => $user_id,
                'checkin_date' => $request->day_id,
                'checkin_time' => $request->checkin_time,
                'checkout_time' => null,
                'number_minutes_late' => $number_minutes_late,
                'number_minutes_quit_early' => $number_minutes_quit_early,
            ]);
            $time_entry_id = $checkin->time_entry_id;
            AttendanceCheck::create([
                'time_entry_id' => $time_entry_id,
                'is_late' => $is_late,
            ]);

            return response()->json(['message' => 'Check in thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Check in thất bại', $e->getMessage()], 422);
        }

    }

    public function CreateCheckout(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            // Giờ quy định
            $work_end = Carbon::parse($request->checkout_time);
            $actual_checkout = Carbon::now();

            $number_minutes_quit_early = 0;
            $is_quit_early = 0;

            // Về sớm
            if ($actual_checkout->lt($work_end)) {
                $number_minutes_quit_early = $actual_checkout->diffInMinutes($work_end);
                $is_quit_early = 1;
            }

            $checkout = TimeEntry::where(['checkin_date' => $request->day_id, 'user_id' => $user_id])->first();
            if ($checkout->checkout_time) {
                return response()->json([
                    'message' => 'Bạn đã check out rồi',
                ], 400);
            }
            $checkout->update([
                'checkout_time' => $request->checkout_time,
                'number_minutes_quit_early' => $number_minutes_quit_early,
            ]);

            return response()->json(['message' => 'Check out thành công'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Check out thất bại', $e->getMessage()], 422);
        }

    }

    public function getAttendance()
    {
        $attendance = TimeEntry::with('workingDay')
            ->where('user_id',Auth::id())
            ->orderBy('time_entry_id', 'desc')
            ->get();

        $attendance->transform(function ($item) {

            // Đi muộn
            $lateHours = floor($item->number_minutes_late / 60);
            $lateMinutes = $item->number_minutes_late % 60;

            $item->late_time_text =
                ($lateHours > 0 ? $lateHours.' giờ ' : '').
                ($lateMinutes > 0 ? $lateMinutes.' phút' : '');

            // Về sớm
            $quitHours = floor($item->number_minutes_quit_early / 60);
            $quitMinutes = $item->number_minutes_quit_early % 60;

            $item->quit_early_text =
                ($quitHours > 0 ? $quitHours.' giờ ' : '').
                ($quitMinutes > 0 ? $quitMinutes.' phút' : '');

            return $item;
        });

        return response()->json($attendance);
    }

    public function createExpalaination(Request $request)
    {

        try {
            Expalaination::create([
                'create_date' => $request->create_date,
                'reason' => $request->reason,
                'type' => $request->type,
                'status' => '0',
                'time_entry_id' => $request->time_entry_id,
            ]);

            return response()->json([ 'message' => 'Bạn đã giải trình thành công!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Bạn đã giải trình thất bại', $e->getMessage()], 422);
        }
    }
    public function createOt(Request $request){
        try {
           $start = Carbon::parse($request->start_time);
$end = Carbon::parse($request->end_time);

// Qua ngày hôm sau
if ($end->lessThan($start)) {
    $end->addDay();
}

$totalMinutes = $start->diffInMinutes($end);
$sum_time = round($totalMinutes / 60, 2);
            Ot::create([
                'ot_date' => Carbon::now(),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'sum_hours_ot' => $sum_time,
                'reason' => $request->reason,
                'status' => 0,
                'user_id' => Auth::id(),
                'type_id' => $request->type_id,
            ]);
        return response()->json([ 'message' => 'Bạn đã xin Ot thành công!'], 200);

        } catch (\Throwable $e) {
            return response()->json(['message' => 'Bạn đã xin OT thất bại', $e->getMessage()], 422);
        }
    }
}
