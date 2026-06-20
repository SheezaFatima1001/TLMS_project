<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Employee') }}</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title"> Edit Employee</div>
                    <div class="card-subtitle">Update employee information</div>
                </div>
            </div>

            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" value="{{ $employee->name }}" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" value="{{ $employee->email }}" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
                    <p style="color: #94a3b8; font-size: 12px; margin-top: 6px;">Leave blank to keep the current password</p>
                </div>

                <div class="form-buttons">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>