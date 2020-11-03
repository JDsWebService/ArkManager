<?php

namespace App\Exceptions;

use Exception;

class DinoHandlerException extends Exception
{
    protected $message = "Err: DinoHandlerException Generic";

    public function render($request)
    {
        return redirect()
            ->back()
            ->withInput($request->input())
            ->withErrors(['message' => $this->message]);
    }
}
