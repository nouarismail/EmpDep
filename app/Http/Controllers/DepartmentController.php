<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return Department::with('employees')->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dept_name' => 'required|string|max:100|unique:departments,dept_name',
        ]);

        $department = Department::create($data);

        return response()->json($department, 201);
    }

    public function show(Department $department)
    {
        return $department->load('employees');
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'dept_name' => 'sometimes|string|max:100|unique:departments,dept_name,' . $department->id,
        ]);

        $department->update($data);

        return response()->json($department);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->noContent();
    }
}
