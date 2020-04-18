<?php

namespace App\Observer;

/***
 * Observable is the subject whose state changes
 * He, the subject, notifies of his state changes to observers
 * He represents the one side of the one-many relationship
 *
 * Interface ObservableInterface
 * @package App\ObserverInterface
 */
interface ObservableInterface
{
    /**
     * Add a new observer
     *
     * @param Observer $observer
     * @return void
     */
    public function attach(Observer $observer): void;

    /**
     * Remove an observer
     * @param Observer $observer
     * @return void
     */
    public function detach(Observer $observer): void;

    /**
     * Notifies observer of its changes
     * @return void
     */
    public function notify(): void;
}