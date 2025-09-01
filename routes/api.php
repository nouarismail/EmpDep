<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentEmployeeController;

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('departments', DepartmentController::class);

Route::post('department-employee/attach', [DepartmentEmployeeController::class, 'attach']);
Route::post('department-employee/detach', [DepartmentEmployeeController::class, 'detach']);
