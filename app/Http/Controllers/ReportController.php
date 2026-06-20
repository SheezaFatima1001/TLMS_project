<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Get all employees for dropdown
        $employees = User::orderBy('name')->get();
        
        // Get current month data by default
        $selectedEmployee = request('employee_id', auth()->id());
        
        $logs = AttendanceLog::where('user_id', $selectedEmployee)
            ->when(request('month'), function($query) {
                return $query->whereMonth('date', request('month'));
            })
            ->when(request('year'), function($query) {
                return $query->whereYear('date', request('year'));
            })
            ->orderBy('date', 'desc')
            ->get();
            
        // Calculate totals
        $totalHours = $logs->sum('hours_worked') / 60;
        $totalDays = $logs->where('status', 'Present')->count();
        
        return view('reports.index', compact('logs', 'employees', 'selectedEmployee', 'totalHours', 'totalDays'));
    }
}