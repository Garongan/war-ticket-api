<?php

namespace App\Utils;

class CommonResponse
{
    public function commonResponse(int $statusCode, array $message)
    {
        return response()->json(['statusCode' => $statusCode, 'data' => $message], $statusCode)->header('Accept', 'application/json');
    }
}
