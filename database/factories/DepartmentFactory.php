<?php

namespace Database\Factories;

use App\Domain\Departments\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        return [
            'dept_name' => $this->faker->unique()->company(),
            'created_by_user_id' => null,
            'updated_by_user_id' => null,
            'deleted_by_user_id' => null,
        ];
    }
}
