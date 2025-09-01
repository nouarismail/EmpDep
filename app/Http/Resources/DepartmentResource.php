<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'dept_name' => $this->dept_name,

            
            'from_date' => $this->pivot->from_date ?? null,
            'to_date'   => $this->pivot->to_date ?? null,
        ];
    }
}
