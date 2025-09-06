<?php

namespace App\Domain\Departments\ViewModels;

use App\Support\ViewModels\BaseViewModel;
use App\Domain\Departments\Models\Department;

class DepartmentIndexVM extends BaseViewModel
{
    public function toArray(): array
    {
        $perPage = (int)($this->params['per_page'] ?? config('pagination.per_page', 15));

        $p = Department::query()
            ->with('translated')  
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
