<?php

namespace App\Event;

use App\Exception\DoubleEventException;
use App\Subscriber\SubscriberInterface;

class Emitter
{
    private static $_instance;

    /**
     * Stocks listeners list
     * @var Listener[][]
     */
    private $listeners = [];

    /**
     * Allows to retrieve the emitter's instance
     * If no instance found, then created it one according to Singleton design pattern
     * @return Emitter
     */
    public static function getInstance(): Emitter
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Sends an event
     * @param string $event
     * @param mixed ...$args
     */
    public function emit(string $event, ...$args)
    {
        if ($this->hasListeners($event)) {
            foreach ($this->listeners[$event] as $listener) {
                $listener->handle($args);
                if ($listener->getStopPropagation()) { // Stop execution if propagation = true
                    break;
                }
            }
        }
    }

    /**
     * Listen an event
     * @param string $event
     * @param callable $callback
     * @param int $priority
     * @return Listener
     * @throws DoubleEventException
     */
    public function on(string $event, callable $callback, int $priority = 0): Listener
    {
        // Verifies whether event exists
        if (!$this->hasListeners($event)) {
            $this->listeners[$event] = [];
        }

        $this->checkDoubleCallableForEvent($event, $callback);

        $listener = new Listener($callback, $priority);

        $this->listeners[$event][] = $listener;
        $this->sortListeners($event);

        return $listener;
    }

    /**
     * Add a subscriber which will listen several events
     * @param SubscriberInterface $subscriber
     * @return void
     * @throws DoubleEventException
     */
    public function addSubscriber(SubscriberInterface $subscriber): void
    {
        foreach ($subscriber->getEvents() as $event => $method) {
            $this->on($event, [$subscriber, $method]);
        }
    }

    /**
     * Allow to listen a event once et run listener once as well
     * @param string $event
     * @param callable $callback
     * @param int $priority
     * @return Listener
     * @throws DoubleEventException
     */
    public function once(string $event, callable $callback, int $priority = 0): Listener
    {
        return $this->on($event, $callback, $priority)->once();
    }

    /**
     * Verify whether event exists
     * @param string $event
     * @return bool
     */
    private function hasListeners(string $event): bool
    {
       return array_key_exists($event, $this->listeners);
    }

    private function sortListeners(string $event)
    {
        uasort($this->listeners[$event], function ($a, $b) {
            return $a->getPriority() < $b->getPriority();
        });
    }

    /**
     * @param string $event
     * @param callable $callback
     * @return bool
     * @throws DoubleEventException
     */
    private function checkDoubleCallableForEvent(string $event, callable $callback): bool
    {
        foreach ($this->listeners[$event] as $listener) {
            if ($listener->getCallback() === $callback) {
                throw new DoubleEventException();
            }
        }
        return false;
    }
}