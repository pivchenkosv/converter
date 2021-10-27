<?php

namespace App\ResultTypes;

class Success
{
    private mixed $result;

    public function __construct(mixed $result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }
}
