<?php

namespace App\Http\Requests;

use App\Exceptions\RequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class CustomFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        
        $e = (new ValidationException($validator));
        throw new RequestException(
            json_encode($e->errors(), JSON_UNESCAPED_UNICODE),
            null,
            422
        );
    }

    
    public function validationData(): array
    {
        return $this->all() + $this->route()?->parameters() ?? [];
    }

    abstract public function rules(): array;
}
