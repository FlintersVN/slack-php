<?php

namespace Slack\Block;

class Actions extends Element
{
    public $type = 'actions';

    public $elements = [];

    public $block_id;

    public function __construct(Element ...$elements)
    {
        $this->elements = $elements;
    }

    public static function button(Button $button)
    {
        return new static($button);
    }

    public static function buttons(Button ...$buttons)
    {
        return static::actions(...$buttons);
    }

    public static function actions(Element ...$actions)
    {
        return new static(...$actions);
    }

    public function addElement(Element $element)
    {
        $this->elements[] = $element;

        return $this;
    }
}