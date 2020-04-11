<?php


namespace App\Composition;

/**
 * Traits define a behaviour of an object, so no need
 * to duplicate code. In order to use traits, use above class
 * attributes and methods definition 'use NameOfTrait, NameOfSecondTrait, ...;'
 * Normally traits ending is -able
 * Can use all traits you want in a class by separating them with commas
 * Traits cans extend another traits as well
 * Trait Giftable
 * @package App\Composition
 */
trait Giftable
{
    private $gift = false;

    private function getGift()
    {
        $this->gift = false;
    }

    public function setGift(bool $gift): self
    {
        $this->gift = $gift;
        return $this;
    }
}