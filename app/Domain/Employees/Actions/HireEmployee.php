<?php

namespace App\Domain\Employees\Actions;

use App\Domain\Employees\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Domain\Employees\DTOs\EmployeeDto;

class HireEmployee
{
    public function execute(EmployeeDto $dto): Employee
    {
        return Employee::create([
            'first_name'         => $dto->first_name,
            'last_name'          => $dto->last_name,
            'hire_date'          => $dto->hire_date ?? now()->toDateString(),
            'created_by_user_id' => $dto->created_by_user_id ?? 1,
        ]);
    }
}