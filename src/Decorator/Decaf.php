<?php


namespace App\Decorator;


class Decaf implements Beverage
{
    const COST = 1.0;

    public function getCost(): float
    {
        return self::COST;
    }

    function getName(): string
    {
        return 'Beverage: ' . 'DECAF';
    }
}