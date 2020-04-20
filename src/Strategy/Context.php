<?php

namespace App\Strategy;

class Context
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(): int {
        return $this->strategy->doOperation();
    }
}