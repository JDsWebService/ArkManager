<?php

namespace App\Exceptions\Logging;

use Exception;

class LogException extends Exception
{
    protected $message = "Err: LogException Generic";

    public function render($request)
    {
        return redirect()
            ->back()
            ->withInput($request->input())
            ->withErrors(['message' => "LogException: " . $this->message]);
    }
}
