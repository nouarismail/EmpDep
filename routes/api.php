<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentEmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewModelController;

Route::post('/view_models/request',        [ViewModelController::class, 'request']);
Route::post('/data_collections/execute',   [ViewModelController::class, 'executeCollection']);



Route::post('/auth/signup',  [AuthController::class, 'signup']);
Route::post('/auth/login',   [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);

Route::middleware('auth:api')->group(function () {
    Route::get('/auth/me',    [AuthController::class, 'me']);
    Route::post('/auth/logout',[AuthController::class, 'logout']);
});

Route::apiResource('employees', EmployeeController::class);

Route::apiResource('departments', DepartmentController::class);

Route::post('department-employee/attach', [DepartmentEmployeeController::class, 'attach']);
Route::post('department-employee/detach', [DepartmentEmployeeController::class, 'detach']);
