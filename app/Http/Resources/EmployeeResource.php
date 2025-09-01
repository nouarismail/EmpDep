<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'hire_date'  => $this->hire_date,

            
            'departments' => DepartmentResource::collection($this->whenLoaded('departments')),
        ];
    }
}
