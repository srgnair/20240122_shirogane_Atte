<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use DateTime;

class TimeStampController extends Controller
{

    public function stampStart()
    {
        $user = Auth::user();

        $todayStampStart = Attendance::where('user_id', $user->id)
            ->whereDate('clock_in_time', Carbon::today())
            ->first();

        if ($todayStampStart) {
            return redirect()->back()->with('error', 'すでに出勤開始されています');
        }

        Attendance::create([
            'user_id' => $user->id,
            'clock_in_time' => now(),
        ]);

        return redirect()->back()->with('my_status', '出勤を打刻しました');
    }

    public function stampEnd()
    {
        $user = Auth::user();
        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('clock_in_time', Carbon::today())
            ->first();

        $lastRest = Rest::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->latest()->first();

        $lastAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->latest()->first();

        if (!$todayAttendance) {
            return redirect()->back()->with('error', '先に出勤を打刻してください');
        }

        if ($lastRest && $lastRest->rest_end_time === null) {
            return redirect()->back()->with('error', '先に休憩を終了してください');
        }

        if ($lastAttendance && $lastAttendance->clock_out_time !== null) {
            return redirect()->back()->with('error', '本日はすでに退勤打刻済みです');
        }

        Attendance::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->update(['clock_out_time' => Carbon::now()]);

        return redirect()->back()->with('my_status', '退勤を打刻しました');
    }

    public function stampRestStart()
    {
        $user = Auth::user();

        $todayStampStart = Attendance::where('user_id', $user->id)
            ->whereDate('clock_in_time', Carbon::today())
            ->first();

        $lastRest = Rest::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->first();

        if (!$todayStampStart) {
            return redirect()->back()->with('error', '先に出勤を打刻してください');
        }

        if ($lastRest && $lastRest->rest_end_time === null) {
            return redirect()->back()->with('error', 'すでに休憩中です');
        }

        if ($todayStampStart && $todayStampStart->clock_out_time !== null) {
            return redirect()->back()->with('error', '本日はすでに退勤打刻済みです');
        }

        Rest::create([
            'user_id' => $user->id,
            'rest_start_time' => now(),
        ]);

        return redirect()->back()->with('my_status', '休憩が開始されました');
    }

    public function stampRestEnd()
    {
        $user = Auth::user();

        $todayStampStart = Attendance::where('user_id', $user->id)
            ->whereDate('clock_in_time', Carbon::today())
            ->first();

        $lastRestStart = Rest::where('user_id', $user->id)
            ->whereNotNull('rest_start_time')
            ->latest()
            ->first();

        if (!$todayStampStart) {
            return redirect()->back()->with('error', '先に出勤を打刻してください');
        }

        if (!$lastRestStart || !$lastRestStart->rest_start_time || $lastRestStart->rest_end_time !== null) {
            return redirect()->back()->with('error', '先に休憩を開始してください');
        }

        if ($todayStampStart !== null && $todayStampStart->clock_out_time !== null) {
            return redirect()->back()->with('error', '本日はすでに退勤打刻済みです');
        }

        Rest::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->update(['rest_end_time' => Carbon::now()]);

        return redirect()->back()->with('my_status', '休憩が終了されました');
    }


    public function dateView(Request $request, $date = null)
    {
        $users = User::with('attendances', 'rests')->get();
        $urlDate = $request->input('date');

        $formattedAttendances = collect([]);
        $attendances = null;
        $nextAttendances = null;
        $prevAttendances = null;

        if ($date === null) {
            $date = Carbon::today();
        } else {
            $date = Carbon::parse($date);
        }

        if ($date) {

            $dateFromUrl = $date->startOfDay();
            $dateFromUrlFormat
                = $date->startOfDay()->format('Y-m-d');
            $nextDate = $date->copy()->addDay();
            $prevDate = $date->copy()->subDay();

            $user =
                User::with('attendances', 'rests')->get();

            $attendances = Attendance::with('rests')->whereDate('clock_in_time', $dateFromUrl)->Paginate(5);
            $nextAttendances = Attendance::whereDate('clock_in_time', $dateFromUrl->copy()->addDay())->Paginate(5);
            $prevAttendances = Attendance::whereDate('clock_in_time', $dateFromUrl->copy()->subDay())->Paginate(5);

            $totalRestTime = [];
            foreach ($attendances as $attendance) {
                $attendance->load('rests');

                $rests = $attendance->getRelation('rests');
                foreach ($rests as $rest) {
                    $date = substr($rest->rest_start_time, 0, 10);
                    $start = Carbon::parse($rest->rest_start_time);
                    $end = Carbon::parse($rest->rest_end_time);

                    if (!isset($totalRestTime[$date])) {
                        $totalRestTime[$date] = \Carbon\CarbonInterval::seconds(0);
                    }

                    $totalRestTime[$date] = $totalRestTime[$date]->add($start->diff($end));
                }
            }
        }

        return view('date', compact(
            'users',
            'dateFromUrl',
            'dateFromUrlFormat',
            'attendances',
            'nextAttendances',
            'prevAttendances',
            'date',
            'nextDate',
            'prevDate',
            'totalRestTime',
        ));
    }

    public function UserDateView(Request $request, $date = null)
    {
        $users = User::with('attendances', 'rests')->get();
        $urlUser = $request->username;
        $urlDate = $request->input('date');

        $formattedAttendances = collect([]);
        $attendances = null;

        if (
            $date === null
        ) {
            $date = Carbon::today();
        } else {
            $date = Carbon::parse($date);
        }

        if ($date) {

            $dateFromUrl = $date->startOfMonth();
            $dateFromUrlFormat
                = $date->startOfMonth()->format('Y-m');
            $nextDate = $date->copy()->addMonth();
            $prevDate = $date->copy()->subMonth();

            $user = User::where('name', $urlUser)->first();

            $attendances = $user->attendances()
                ->with('rests')
                ->whereDate('clock_in_time', $dateFromUrl)
                ->paginate(5);

            $totalRestTime = [];
            foreach ($user->rests as $rest) {
                $date = substr($rest->rest_start_time, 0, 10);
                $start = Carbon::parse($rest->rest_start_time);
                $end = Carbon::parse($rest->rest_end_time);

                if (!isset($totalRestTime[$date])) {
                    $totalRestTime[$date] = 0;
                }
                $totalRestTime[$date] += $start->diffInSeconds($end);
            }

            return view('user-date', compact(
                'date',
                'users',
                'urlUser',
                'urlDate',
                'attendances',
                'dateFromUrlFormat',
                'nextDate',
                'prevDate',
                'user',
                'totalRestTime',
            ));
        }
    }

    public function usersView()
    {
        $users = User::all();
        return view('users', compact('users'));
    }
}
