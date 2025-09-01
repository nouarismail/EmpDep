<?php

namespace App\Http\Requests;

class StoreEmployeeRequest extends CustomFormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required','string','max:50'],
            'last_name'  => ['required','string','max:50'],
            'hire_date'  => ['required','date'],
        ];
    }
}
