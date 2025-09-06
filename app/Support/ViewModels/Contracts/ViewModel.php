<?php

namespace App\Support\ViewModels\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface ViewModel extends Arrayable
{
    
    public static function make(array $params = []): static;
}
