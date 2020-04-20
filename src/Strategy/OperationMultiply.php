<?php


namespace App\Strategy;


class OperationMultiply extends Strategy
{
    /**
     * @return int
     */
    public function doOperation(): int
    {
        return $this->num1 * $this->num2;
    }
}