<?php

namespace App\Observer;

/**
 * Observer is the object who observes observable's changes
 * He, the client, needs to be notified of observables's changes to update dependent observers
 * He represents the many side of the one-many relationship
 *
 * class Observer
 * @package App\Observer
 */
abstract class Observer
{
    protected $observable;

    public function __construct(ObservableInterface $observable)
    {
        $this->observable = $observable;
        $this->observable->attach($this);
    }

    public abstract function update();
}