<?php

return [
    
    'department.dashboard' => [
        ['name' => 'departments.show',        'map' => ['department_id' => 'department_id']],
        ['name' => 'dept_emp.by_department',  'map' => ['department_id' => 'department_id']],
    ],

    
    'employee.dashboard' => [
        ['name' => 'employees.show',        'map' => ['employee_id' => 'employee_id']],
        ['name' => 'dept_emp.by_employee',  'map' => ['employee_id' => 'employee_id']],
    ],
];
