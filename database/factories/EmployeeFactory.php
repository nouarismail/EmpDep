<?php

namespace Database\Factories;

use App\Domain\Employees\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'hire_date'  => $this->faker->date(),
            'created_by_user_id' => null,
            'updated_by_user_id' => null,
            'deleted_by_user_id' => null,
        ];
    }
}
