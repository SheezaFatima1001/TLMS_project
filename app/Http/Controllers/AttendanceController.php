<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // 1. Show Attendance Dashboard
    public function index()
    {
        // Get current user logs
        $logs = AttendanceLog::where('user_id', Auth::id())
                    ->orderBy('date', 'desc')
                    ->get();
        return view('attendance.index', compact('logs'));
    }

    // 2. Clock In Action
    public function clockIn()
    {
        $today = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();

        // Check if already clocked in
        $existingLog = AttendanceLog::where('user_id', Auth::id())
                           ->where('date', $today)
                           ->first();

        if ($existingLog && $existingLog->clock_in) {
            return redirect()->back()->with('error', 'You are already Clocked In.');
        }

        AttendanceLog::create([
            'user_id' => Auth::id(),
            'date' => $today,
            'clock_in' => $time,
            'status' => 'Present'
        ]);

        return redirect()->back()->with('success', 'Clocked In successfully at ' . $time);
    }

    // 3. Clock Out Action
    public function clockOut()
    {
        $today = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();

        $log = AttendanceLog::where('user_id', Auth::id())
                   ->where('date', $today)
                   ->first();

        if (!$log || !$log->clock_in) {
            return redirect()->back()->with('error', 'You must clock in first.');
        }

        // Calculate duration (Simple logic)
        $clockIn = Carbon::createFromTimeString($log->clock_in);
        $clockOut = Carbon::createFromTimeString($time);
        $diffInMinutes = $clockIn->diffInMinutes($clockOut);

        $log->update([
            'clock_out' => $time,
            'hours_worked' => $diffInMinutes
        ]);

        return redirect()->back()->with('success', 'Clocked Out successfully.');
    }
}