<?php

namespace App\Exceptions;

use Exception;

class TribeException extends Exception
{
    protected $message = "Err: TribeException Generic";

    public function render($request)
    {
        return redirect()
            ->back()
            ->withInput($request->input())
            ->withErrors(['message' => $this->message]);
    }
}
