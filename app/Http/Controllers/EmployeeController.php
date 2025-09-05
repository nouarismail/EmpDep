<?php

namespace App\Http\Controllers;

use App\Domain\Employees\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use App\Domain\Employees\Actions\HireEmployee;
use App\Domain\Employees\DTOs\EmployeeDto;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);

        $query = Employee::query()->with('departments');


        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        return EmployeeResource::collection(
            $query->paginate($perPage)
        );
    }

    public function store(StoreEmployeeRequest $request, HireEmployee $hireEmployee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'hire_date'  => 'nullable|date',
        ]);

        $dto = EmployeeDto::fromRequest($validated);

        $employee = $hireEmployee->execute($dto);




        return (new EmployeeResource($employee))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee->load('departments'));
    }

    // public function update(UpdateEmployeeRequest $request, Employee $employee)
    // {
    //     $employee->update($request->validated());

    //     return new EmployeeResource($employee->load('departments'));
    // }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->noContent();
    }
}
