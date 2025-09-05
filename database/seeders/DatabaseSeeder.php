<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Domain\Employees\Models\Employee;
use App\Domain\Departments\Models\Department;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $departments = Department::factory(10)->create();

        
        $employees = Employee::factory(100)->create();

        
        $employees->each(function ($employee) use ($departments) {
            $employee->departments()->attach(
                $departments->random(rand(1,3))->pluck('id')->toArray(),
                [
                    'from_date' => now()->subYears(rand(1, 10)),
                    'to_date'   => null,
                ]
            );
        });
    }
}
