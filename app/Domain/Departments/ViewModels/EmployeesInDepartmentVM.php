<?php

namespace App\Domain\Departments\ViewModels;

use App\Support\ViewModels\BaseViewModel;
use App\Domain\Departments\Models\Department;

class EmployeesInDepartmentVM extends BaseViewModel
{
    public function toArray(): array
    {
        $departmentId = (int)($this->params['department_id'] ?? 0);

        $dept = Department::with([
            'employees' => function ($q) {
                $q->select('employees.id', 'first_name', 'last_name')
                  ->withPivot(['from_date', 'to_date']);
            },
        ])->findOrFail($departmentId);

        return [
            'department_id'   => $dept->id,
            'department_name' => $dept->dept_name,
            'employees'       => $dept->employees->map(function ($e) {
                return [
                    'id'         => $e->id,
                    'first_name' => $e->first_name,
                    'last_name'  => $e->last_name,
                    'from_date'  => $e->pivot->from_date,
                    'to_date'    => $e->pivot->to_date,
                ];
            })->values(),
        ];
    }
}
