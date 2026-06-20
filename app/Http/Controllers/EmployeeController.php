<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // Show all employees
    public function index()
    {
        $employees = User::orderBy('name')->get();
        return view('employees.index', compact('employees'));
    }

    // Create new employee form
    public function create()
    {
        return view('employees.create');
    }

    // Store new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }

    // Edit employee form
    public function edit(User $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, User $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $employee->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    // Delete employee
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}