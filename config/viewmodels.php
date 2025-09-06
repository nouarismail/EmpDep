<?php

return [
    'departments.index'  => App\Domain\Departments\ViewModels\DepartmentIndexVM::class,
    'departments.show'   => App\Domain\Departments\ViewModels\DepartmentShowVM::class,

    'employees.index'    => App\Domain\Employees\ViewModels\EmployeeIndexVM::class,
    'employees.show'     => App\Domain\Employees\ViewModels\EmployeeShowVM::class,

    'dept_emp.by_department' => App\Domain\Departments\ViewModels\EmployeesInDepartmentVM::class,
    'dept_emp.by_employee'   => App\Domain\Employees\ViewModels\DepartmentsOfEmployeeVM::class,
];
