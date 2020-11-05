<?php

namespace App\Exceptions\ArkIDParser;

use Exception;

class CardException extends Exception
{
    protected $message = "Err0: CardException - Generic";

    public function render()
    {
        return ['message' => $this->message];
    }
}
