<?php

namespace App\Domain\Employees\ViewModels;

use App\Support\ViewModels\BaseViewModel;
use App\Domain\Employees\Models\Employee;

class DepartmentsOfEmployeeVM extends BaseViewModel
{
    public function toArray(): array
    {
        $employeeId = (int)($this->params['employee_id'] ?? 0);

        $emp = Employee::with([
            'departments' => function ($q) {
                $q->select('departments.id', 'dept_name')
                  ->withPivot(['from_date', 'to_date']);
            },
        ])->findOrFail($employeeId);

        return [
            'employee_id' => $emp->id,
            'name'        => "{$emp->first_name} {$emp->last_name}",
            'departments' => $emp->departments->map(function ($d) {
                return [
                    'id'        => $d->id,
                    'dept_name' => $d->dept_name,
                    'from_date' => $d->pivot->from_date,
                    'to_date'   => $d->pivot->to_date,
                ];
            })->values(),
        ];
    }
}
