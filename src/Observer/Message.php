<?php

namespace App\Observer;

class Message extends Observer
{
    /**
     * @return mixed
     */
    public function update()
    {
        switch ($this->observable->getStatus()) {
            case TestResultEvent::EXCELLENT:
                $message = 'Excellent work'; break;
            case TestResultEvent::VERY_GOOD:
                $message = 'Very well done'; break;
            case TestResultEvent::REGULAR:
                $message = 'You can do more'; break;
            default: $message = 'You must work harder'; break;
        }
        return dump($message);
    }
}