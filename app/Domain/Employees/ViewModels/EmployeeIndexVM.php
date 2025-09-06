<?php

namespace App\Domain\Employees\ViewModels;

use App\Support\ViewModels\BaseViewModel;
use App\Domain\Employees\Models\Employee;


class EmployeeIndexVM extends BaseViewModel
{
    public function toArray(): array
    {
        $perPage = (int)($this->params['per_page'] ?? config('pagination.per_page', 15));

        $p = Employee::query()
            ->orderBy('id')
            ->paginate($perPage);

        return [
            'total'        => $p->total(),
            'per_page'     => $p->perPage(),
            'current_page' => $p->currentPage(),
            'data'         => $p->items(),
        ];
    }
}
