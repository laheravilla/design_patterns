<?php


namespace App\Decorator;

use App\Entity\PrintText;

/**
 * Decorator classes accept classes to be decorated
 * Class TextDecorator
 * @package App\Decorator
 */
class TextDecorator
{
    private $text;

    public function __construct(PrintText $text)
    {
        $this->text = $text;
    }

    public function textToUppercase()
    {
        return strtoupper($this->text->getText());
    }
}