<?php

namespace Slack;

class PlainText extends Text
{
    public function __construct(string $text)
    {
        parent::__construct($text, static::TYPE_PLAIN_TEXT);
    }

    public static function make($text)
    {
        return new static($text);
    }
}