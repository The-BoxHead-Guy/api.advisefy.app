<?php

namespace App\Exceptions;

use Exception;

class PiecesOfAdviceException extends Exception
{
    protected $code = 404;
    protected $message = 'Piece of advice not found';

    public function __construct(string $message, int $code)
    {
        $this->message = $message ?? $this->message;
        $this->code = $code ?? $this->code;
        parent::__construct($this->message, $this->code);
    }
}
