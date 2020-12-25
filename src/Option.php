<?php

namespace Slack;

class Option extends Element
{
    public $text;

    public $value;

    public $url;

    public function __construct(PlainText $text, string $value, string $url = null)
    {
        $this->text = $text;
        $this->value = $value;
        $this->url = $url;
    }

    public static function url(string $text, string $value, string $url)
    {
        return new static(PlainText::make($text), $value, $url);
    }
}