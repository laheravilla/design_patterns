<?php

namespace App\Decorator;

interface Beverage
{
    function getName(): string;

    function getCost(): float;
}