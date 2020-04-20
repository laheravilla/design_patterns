<?php

namespace App\Decorator;

class CaramelDecorator extends AddonDecorator
{
    const COST = 0.99;

    public function getName(): string
    {
        return parent::getName() . ' - with: ' . 'CARAMEL';
    }

    public function getCost(): float
    {
        return parent::getCost() + self::COST;
    }
}