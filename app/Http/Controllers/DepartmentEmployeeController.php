<?php

namespace App\Http\Controllers;

use App\Models\DepartmentEmployee;
use Illuminate\Http\Request;

class DepartmentEmployeeController extends Controller
{
    public function attach(Request $request)
    {
        $data = $request->validate([
            'employee_id'  => 'required|exists:employees,id',
            'department_id'=> 'required|exists:departments,id',
            'from_date'    => 'required|date',
            'to_date'      => 'nullable|date|after_or_equal:from_date',
        ]);

        $relation = DepartmentEmployee::create($data);

        return response()->json($relation, 201);
    }

    public function detach(Request $request)
    {
        $data = $request->validate([
            'employee_id'  => 'required|exists:employees,id',
            'department_id'=> 'required|exists:departments,id',
        ]);

        DepartmentEmployee::where($data)->delete();

        return response()->noContent();
    }
}
