<?php

namespace Slack\Block;

class File extends Element
{
    public $type = 'file';

    public $external_id;

    public $source;

    public $block_id;

    public function __construct(string $external_id, string $source, string $block_id = null)
    {
        $this->external_id = $external_id;
        $this->source = $source;
        $this->block_id = $block_id;
    }
}