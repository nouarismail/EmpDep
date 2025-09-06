<?php

namespace App\Domain\Departments\ViewModels;

use App\Support\ViewModels\BaseViewModel;
use App\Domain\Departments\Models\Department;

class DepartmentShowVM extends BaseViewModel
{
    public function toArray(): array
    {
        $id = (int)($this->params['department_id'] ?? 0);

        $dept = Department::with([
            'translated',
            'employees' => fn ($q) => $q->select('employees.id', 'first_name', 'last_name'),
        ])->findOrFail($id);

        return ['department' => $dept];
    }
}
