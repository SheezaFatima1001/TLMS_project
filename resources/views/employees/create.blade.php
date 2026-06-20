<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Add New Employee') }}</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title">➕ Add New Employee</div>
                    <div class="card-subtitle">Enter employee details below</div>
                </div>
            </div>

            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-input" placeholder="Enter full name" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter email address" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter password" required>
                </div>

                <div class="form-buttons">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Add Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>