<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage() ?? 'Resource not found',
        ], 404);
    }
}
