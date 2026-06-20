<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        
        <!-- Welcome Banner -->
         <div class="welcome-banner">
            <div class="title">Welcome back, {{ Auth::user()->name }}! </div>
            <div class="subtitle">Here's what's happening with your attendance today</div>
            <div class="date">{{ now()->format('l, d F Y') }}</div>
        </div>

        <!-- Stats Cards -->
        <div class="stat-grid">
            <!-- Card 1 -->
            <div class="stat-card">
                <div class="icon green"><i class="fas fa-clock"></i></div>
                <div class="label">Today's Status</div>
                @php
                    $todayLog = \App\Models\AttendanceLog::where('user_id', Auth::id())->where('date', now()->toDateString())->first();
                @endphp
                <div class="value">
                    @if($todayLog && $todayLog->clock_in && !$todayLog->clock_out)
                        <span style="color: #10b981;">Working</span>
                    @elseif($todayLog && $todayLog->clock_in)
                        <span style="color: #3b82f6;">Completed</span>
                    @else
                        <span style="color: #94a3b8;">Not Started</span>
                    @endif
                </div>
            </div>

            <!-- Card 2 -->
            <div class="stat-card">
                <div class="icon purple"><i class="fas fa-hourglass-half"></i></div>
                <div class="label">This Month</div>
                @php
                    $monthLogs = \App\Models\AttendanceLog::where('user_id', Auth::id())->whereMonth('date', now()->month)->whereYear('date', now()->year)->sum('hours_worked');
                @endphp
                <div class="value">{{ number_format($monthLogs / 60, 1) }} <span class="sub-value">hrs</span></div>
            </div>

            <!-- Card 3 -->
            <div class="stat-card">
                <div class="icon blue"><i class="fas fa-calendar-check"></i></div>
                <div class="label">Days Present</div>
                @php
                    $presentDays = \App\Models\AttendanceLog::where('user_id', Auth::id())->where('status', 'Present')->count();
                @endphp
                <div class="value">{{ $presentDays }}</div>
            </div>

            <!-- Card 4 -->
            <div class="stat-card">
                <div class="icon orange"><i class="fas fa-users"></i></div>
                <div class="label">Employees</div>
                <div class="value">@php echo \App\Models\User::count(); @endphp</div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="two-column">
            <!-- Left Column -->
            <div>
                <!-- Quick Actions -->
                <div class="card" style="margin-bottom: 24px;">
                    <div class="card-header">
                        <div class="card-title"> Quick Actions</div>
                    </div>
                    <div class="quick-actions" style="display: block;">
                        <a href="{{ route('attendance.index') }}" class="quick-action green">
                            <i class="fas fa-sign-in-alt"></i>
                            <div><div class="label">Clock In / Out</div><div class="desc">Mark your attendance</div></div>
                        </a>
                        <a href="{{ route('employees.index') }}" class="quick-action purple" style="margin-top: 12px;">
                            <i class="fas fa-user-plus"></i>
                            <div><div class="label">Add Employee</div><div class="desc">Register new employee</div></div>
                        </a>
                        <a href="{{ route('reports.index') }}" class="quick-action blue" style="margin-top: 12px;">
                            <i class="fas fa-chart-bar"></i>
                            <div><div class="label">View Reports</div><div class="desc">Attendance reports</div></div>
                        </a>
                    </div>
                </div>

                <!-- Date Box -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"> Today's Date</div>
                    </div>
                    <div class="date-box">
                        <div class="day">{{ now()->format('d') }}</div>
                        <div class="month">{{ now()->format('F') }}</div>
                        <div class="year">{{ now()->format('Y') }}</div>
                        <div class="weekday">{{ now()->format('l') }}</div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title"> Recent Attendance</div>
                    <a href="{{ route('attendance.index') }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px;">View All</a>
                </div>
                <div class="table-container">
                    <table class="beautiful-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Hours</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentLogs = \App\Models\AttendanceLog::where('user_id', Auth::id())->orderBy('date', 'desc')->limit(7)->get();
                            @endphp
                            @forelse($recentLogs as $log)
                            <tr>
                                <td><span class="font-semibold">{{ $log->date }}</span></td>
                                <td>{{ $log->clock_in ?? '---' }}</td>
                                <td>{{ $log->clock_out ?? '---' }}</td>
                                <td>{{ number_format($log->hours_worked / 60, 2) }} hrs</td>
                                <td><span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">{{ $log->status }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <div class="icon"><i class="fas fa-clock"></i></div>
                                    <div class="title">No attendance records yet</div>
                                    <div class="text">Clock in to start tracking</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>