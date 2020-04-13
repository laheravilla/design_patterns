<?php


namespace App\Event;


class Listener
{
    private $callback;
    private $priority;

    /**
     * Define whether a Listener can be called several times
     * @var bool
     */
    private $once = false;

    /**
     * Indicates how many times Listener has been called
     * @var int
     */
    private $calls = 0;

    /**
     * Allows stop execution
     * @var bool parent events
     */
    private $stopPropagation = false;

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * @return bool
     */
    public function getStopPropagation(): bool
    {
        return $this->stopPropagation;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function __construct(callable $callback, int $priority)
    {
        $this->callback = $callback;
        $this->priority = $priority;
    }

    public function handle(array $args)
    {
        // If calls > 0 stop execution
        if ($this->once && $this->calls > 0) {
            return null;
        }

        $this->calls++;
        return call_user_func_array($this->callback, $args);
    }

    /**
     * Indicate that a listener can be called once
     * Returns a Listener'instance
     * @return $this
     */
    public function once(): self
    {
        $this->once = true;
        return $this;
    }

    /**
     * Allows to stop execution of next event
     * @return Listener
     */
    public function stopPropagation(): Listener
    {
        $this->stopPropagation = true;
        return $this;
    }
}