<?php

namespace App\Strategy;

/**
 * In Strategy pattern, a class behavior or its algorithm
 * can be changed at run time. This type of design pattern comes under behavior pattern.
 * In Strategy pattern, we create objects which represent various strategies and
 * a context object whose behavior varies as per its strategy object.
 * The strategy object changes the executing algorithm of the context object.
 * Class Strategy
 * @package App\Strategy
 */
abstract class Strategy
{
    protected $num1;
    protected $num2;

    public function __construct(int $num1, int $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->doOperation();
    }

    public abstract function doOperation();
}