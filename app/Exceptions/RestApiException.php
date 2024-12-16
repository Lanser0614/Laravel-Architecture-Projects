<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class RestApiException extends Exception implements Renderable
{
    public function render(): JsonResponse|string
    {
        return response()->json([
            'message' => $this->getMessage(),
            "code" => $this->getCode(),
        ], 400);
    }
}
