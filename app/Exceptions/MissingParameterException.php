<?php

namespace App\Exceptions;

use Exception;

class MissingParameterException extends Exception
{
    public function __construct(string $param)
    {
        parent::__construct('Missing parameter '.$param.' in request');
    }
}
