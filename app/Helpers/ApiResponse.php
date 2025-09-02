<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, string $message = 'Success', int $code = 200): array
    {
        return [
            'isSuccessful' => true,
            'code'         => $code,
            'hasContent'   => !empty($data),
            'message'      => $message,
            'data'         => $data,
        ];
    }
    public static function error(
        $message,
        $detailedError = null,
        int $errorCode = 422,
        bool $isLogin = false
    ): array {
        if ($isLogin) {
            return ['success' => false, 'data' => $message];
        }

        return [
            'isSuccessful'  => false,
            'code'          => $errorCode,
            'hasContent'    => false,
            'message'       => $message,
            'detailed_error'=> $detailedError,
            'data'          => null,
        ];
    }
}
