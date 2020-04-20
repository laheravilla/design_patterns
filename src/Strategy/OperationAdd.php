<?php

namespace App\Strategy;

class OperationAdd extends Strategy
{
    /**
     * @return int
     */
    public function doOperation(): int
    {
        return $this->num1 + $this->num2;
    }
}