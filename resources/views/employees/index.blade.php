<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Employees Management') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle" style="margin-right: 10px;"></i>{{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title"> All Employees</div>
                    <div class="card-subtitle">Manage your team members</div>
                </div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                     Add Employee
                </a>
            </div>

            <div class="table-container">
                <table class="beautiful-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Email</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar">{{ substr($employee->name, 0, 1) }}</div>
                                    <span class="name">{{ $employee->name }}</span>
                                </div>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">
                                             Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="icon"><i class="fas fa-users"></i></div>
                                <div class="title">No employees found</div>
                                <div class="text">Add your first employee to get started</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>