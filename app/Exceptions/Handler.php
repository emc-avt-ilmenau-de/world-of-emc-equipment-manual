<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class Handler extends Exception
{
    public function render($request, Throwable $exception)
    {
        // For debugging only—return error details as JSON:
        return response()->json([
            'error'   => true,
            'message' => $exception->getMessage(),
            'trace'   => $exception->getTrace(),
        ], 500);
    }
}
