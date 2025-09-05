<?php

namespace App\Domain\Employees\DTOs;

class EmployeeDto
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public ?string $hire_date = null,
        public ?int $created_by_user_id = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            hire_date: $data['hire_date'] ?? null,
            created_by_user_id: $data['created_by_user_id'] ?? null,
        );
    }
}
