<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Reports') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        
        <!-- Filter Card -->
        <div class="card" style="margin-bottom: 24px;">
            <form action="{{ route('reports.index') }}" method="GET">
                <div style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
                    <div style="flex: 1; min-width: 200px;">
                        <label class="form-label">Employee</label>
                        <select name="employee_id" class="form-input">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $selectedEmployee == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="flex: 1; min-width: 150px;">
                        <label class="form-label">Month</label>
                        <select name="month" class="form-input">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ request('month', now()->month) == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="flex: 1; min-width: 120px;">
                        <label class="form-label">Year</label>
                        <select name="year" class="form-input">
                            @foreach(range(now()->year - 2, now()->year) as $y)
                                <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Summary Stats -->
        <div class="stat-grid" style="margin-bottom: 24px;">
            <div class="stat-card">
                <div class="icon purple"><i class="fas fa-clock"></i></div>
                <div class="label">Total Hours</div>
                <div class="value">{{ number_format($totalHours, 1) }} <span class="sub-value">hrs</span></div>
            </div>
            <div class="stat-card">
                <div class="icon green"><i class="fas fa-calendar-check"></i></div>
                <div class="label">Days Present</div>
                <div class="value">{{ $totalDays }}</div>
            </div>
            <div class="stat-card">
                <div class="icon blue"><i class="fas fa-chart-line"></i></div>
                <div class="label">Average Hours/Day</div>
                <div class="value">{{ $totalDays > 0 ? number_format($totalHours / $totalDays, 1) : 0 }} <span class="sub-value">hrs</span></div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="card">
            <div class="card-header">
                <div class="card-title"> Detailed Report</div>
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
                        @forelse($logs as $log)
                        <tr>
                            <td><span class="font-semibold">{{ $log->date }}</span></td>
                            <td>{{ $log->clock_in ?? '---' }}</td>
                            <td>{{ $log->clock_out ?? '---' }}</td>
                            <td>{{ number_format($log->hours_worked / 60, 2) }}</td>
                            <td><span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">{{ $log->status }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="icon"><i class="fas fa-chart-bar"></i></div>
                                <div class="title">No records found</div>
                                <div class="text">Try different filter options</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>