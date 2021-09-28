<?php

namespace App;

class Message
{
    private string $sender;
    private string $text;

    public function __construct(string $sender, string $text)
    {
        $this->sender = $sender;
        $this->text = $text;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getText(): string
    {
        return $this->text;
    }
}