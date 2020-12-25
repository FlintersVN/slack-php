<?php

namespace Slack\Block;

class Image extends Element implements CombineWithContext
{
    public $type = 'image';

    public $image_url;

    public $alt_text;

    public function __construct(string $image_url, string $alt_text)
    {
        $this->image_url = $image_url;
        $this->alt_text = $alt_text;
    }

    public static function make(string $image_url, string $alt_text)
    {
        return new static($image_url, $alt_text);
    }
}