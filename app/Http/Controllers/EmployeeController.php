<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;


class EmployeeController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(
        Employee::with('departments')->paginate(10)
    );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'hire_date'  => 'required|date',
        ]);

        $employee = Employee::create($data);

        return response()->json($employee, 201);
    }

    public function show(Employee $employee)
    {
        return $employee->load('departments');
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'sometimes|string|max:50',
            'last_name'  => 'sometimes|string|max:50',
            'hire_date'  => 'sometimes|date',
        ]);

        $employee->update($data);

        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->noContent();
    }
}
