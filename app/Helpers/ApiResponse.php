<?php

namespace App\Helpers;

class ApiResponse
{
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
