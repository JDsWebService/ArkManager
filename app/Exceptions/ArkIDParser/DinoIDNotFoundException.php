<?php

namespace App\Exceptions\ArkIDParser;

use Exception;

class DinoIDNotFoundException extends Exception
{
    protected $message = "Err0: DinoIDNotFound - Generic";

    public function render()
    {
        return ['message' => $this->message];
    }
}
