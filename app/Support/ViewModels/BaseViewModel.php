<?php

namespace App\Support\ViewModels;

use App\Support\ViewModels\Contracts\ViewModel;

abstract class BaseViewModel implements ViewModel
{
    protected array $params = [];

    final public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public static function make(array $params = []): static
    {
        return new static($params);
    }
}
