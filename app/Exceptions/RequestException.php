<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class RequestException extends Exception
{
    protected $detailedError;
    protected $isLogin;

    public function __construct(
        string $message = '',
        $detailedError = null,
        int $code = 422,
        bool $isLogin = false,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->detailedError = $detailedError;
        $this->isLogin = $isLogin;
    }

    public function render(Request $request)
    {
        $payload = ApiResponse::error(
            $this->getMessage() !== '' ? json_decode($this->getMessage(), true) : 'Validation error',
            $this->detailedError,
            $this->getCode() ?: 422,
            $this->isLogin
        );

        return response()->json($payload, $this->getCode() ?: 422);
    }
}
