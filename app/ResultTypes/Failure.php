<?php

namespace App\ResultTypes;

class Failure
{
    private string $message;
    private int $code;

    public function __construct(int $code, string $message = '')
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMessage(): mixed
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
}
