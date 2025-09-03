<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\ViewModels\DepartmentIndexVM;
use App\Helpers\ApiResponse;
use Log;

class DepartmentController extends Controller
{
    public function index()
    {
        $vm = new DepartmentIndexVM();

        $response = ApiResponse::success($vm->toArray());
        return response()->json($response, 200);
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
        Log::info('HIT destroy', [
        'id' => $department->id,
        'route' => optional(request()->route())->uri(),
        'method' => request()->method(),
        'path' => request()->path(),
    ]);
        $data = $request->validate([
            'dept_name' => 'sometimes|string|max:100|unique:departments,dept_name,' . $department->id,
        ]);

        $department->update($data);

        return response()->json($department);
    }

    public function destroy(int $id)
    {
         $department = \App\Models\Department::findOrFail($id);
        $department->delete();
        return response()->noContent();
    }
}
