<?php


namespace App\Strategy;


class OperationSubstract extends Strategy
{
    /**
     * @return int
     */
    public function doOperation(): int
    {
        return $this->num1 - $this->num2;
    }

}