<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage() ?? 'A database error occurred',
        ], 500);
    }
}
