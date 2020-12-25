<?php

namespace Slack\Block;

class Divider extends Element
{
    public $type = 'divider';

    public $block_id;

    public function __construct(string $block_id = null)
    {
        $this->block_id = $block_id;
    }

    public static function make(string $block_id = null)
    {
        return new static($block_id);
    }
}