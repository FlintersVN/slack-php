<?php

namespace Slack;

class OptionGroup extends Element
{
    public $label;

    public $options;

    /**
     * OptionGroup constructor.
     * @param PlainText $label
     * @param Option[] $options
     * @throws Exceptions\ItemMustBeInstanceOf
     */
    public function __construct(PlainText $label, $options)
    {
        $this->assertCollectionOf($options, Option::class);
        $this->label = $label;
        $this->options = $options;
    }
}