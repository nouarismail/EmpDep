<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء 10 أقسام
        $departments = Department::factory(10)->create();

        // إنشاء 100 موظف
        $employees = Employee::factory(100)->create();

        // ربط الموظفين بالأقسام عشوائيًا
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
