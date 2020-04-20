<?php

namespace App\Decorator;

class Expresso implements Beverage
{
    const COST = 1.05;

    public function getCost(): float
    {
        return self::COST;
    }

    function getName(): string
    {
        return 'Beverage: ' . 'EXPRESSO';
    }
}