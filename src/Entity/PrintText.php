<?php


namespace App\Entity;


class PrintText
{
    private $text;

    /**
     * @return mixed
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return PrintText
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }
}