<?php

namespace App\Decorator;

class ChocolateDecorator extends AddonDecorator
{
    const COST = 1.05;

    public function getName(): string
    {
        return parent::getName() . ' - with ' . 'Chocolate';
    }

    public function getCost(): float
    {
        return parent::getCost() + self::COST;
    }
}