<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Attendance') }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        
        <!-- Clock Card -->
        <div class="card" style="text-align: center; margin-bottom: 32px;">
            <div style="margin-bottom: 24px;">
                <p style="font-size: 20px; font-weight: 600; color: #64748b;">{{ now()->format('l, d F Y') }}</p>
                <p id="clock" class="clock-display">{{ now()->format('H:i:s') }}</p>
            </div>
            
            <div style="display: flex; justify-content: center; gap: 20px; margin-bottom: 24px;">
                <form action="{{ route('attendance.clockIn') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sign-in-alt"></i> Clock In
                    </button>
                </form>
                
                <form action="{{ route('attendance.clockOut') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Clock Out
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle" style="margin-right: 10px;"></i>{{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>{{ session('error') }}
                </div>
            @endif
        </div>

        <!-- History Table -->
        <div class="card">
            <div class="card-header">
                <div class="card-title"> Attendance History</div>
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
                            <td>{{ number_format($log->hours_worked / 60, 2) }} hrs</td>
                            <td><span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">{{ $log->status }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="icon"><i class="fas fa-clock"></i></div>
                                <div class="title">No attendance records yet</div>
                                <div class="text">Clock in to start tracking your work</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function updateClock() {
            document.getElementById('clock').innerText = new Date().toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
    </script>
</x-app-layout>