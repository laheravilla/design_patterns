<?php

namespace App\Decorator;

/**
 * Decorator classes accept classes to be decorated
 * that is, add functionality
 * Class TextDecorator
 * @package App\Decorator
 */
abstract class AddonDecorator implements Beverage
{
    protected $beverageWith;

    public function __construct(Beverage $beverageWith) {
        $this->beverageWith = $beverageWith;
    }

    public function getName(): string
    {
        return $this->beverageWith->getName();
    }

    public function getCost(): float
    {
        return $this->beverageWith->getCost();
    }
}