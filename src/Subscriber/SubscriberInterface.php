<?php


namespace App\Subscriber;


interface SubscriberInterface
{
    /**
     * @return array
     */
    public function getEvents(): array;
}