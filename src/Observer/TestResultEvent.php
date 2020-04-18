<?php

namespace App\Observer;

class TestResultEvent implements ObservableInterface
{
    const EXCELLENT = 5;
    const VERY_GOOD = 4;
    const REGULAR = 3;
    private $observers = [];
    private $status;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->notify();
    }

    /**
     * Add a new observer
     *
     * @param Observer $newObserver
     * @return void
     */
    public function attach(Observer $newObserver): void
    {
        $this->observers[] = $newObserver;
    }

    /**
     * Remove an observer
     * @param Observer $observer
     * @return void
     */
    public function detach(Observer $observer): void
    {
        $newObservers = [];
        foreach ($this->observers as $obs) {
            if ($obs !== $observer) {
                $newObservers[] = $obs;
            }
        }
        $this->observers = $newObservers;
    }

    /**
     * Notifies observer of its changes
     * @return void
     */
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}