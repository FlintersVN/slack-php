<?php

namespace Slack\Block;

class Context extends Element
{
    public $type = 'context';

    public $block_id;

    public $elements;

    public function __construct(CombineWithContext ...$elements)
    {
        $this->elements = $elements;
    }

    public static function make(CombineWithContext ...$elements)
    {
        return new static(...$elements);
    }
}