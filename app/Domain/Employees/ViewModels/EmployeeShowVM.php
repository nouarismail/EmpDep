<?php

namespace App\Domain\Employees\ViewModels;

use App\Support\ViewModels\BaseViewModel;
use App\Domain\Employees\Models\Employee;

class EmployeeShowVM extends BaseViewModel
{
    public function toArray(): array
    {
        $id = (int)($this->params['employee_id'] ?? 0);

        $emp = Employee::with([
            'departments' => fn ($q) => $q->select('departments.id', 'dept_name'),
        ])->findOrFail($id);

        return ['employee' => $emp];
    }
}