<?php

namespace Slack\Block;

use Slack\Block\Element as BlockElement;
use Slack\Exceptions\ItemMustBeInstanceOf;
use Slack\Text;

class Section extends Element
{
    public $type = 'section';

    public $block_id;

    /**
     * @var Text
     */
    public $text;

    public $fields;

    /**
     * @var BlockElement
     */
    public $accessory;

    /**
     *
     * @param $id
     * @param Text $text
     * @param null $fields
     * @param BlockElement|null $accessory
     * @throws ItemMustBeInstanceOf
     */
    public function __construct(Text $text, $fields = null, BlockElement $accessory = null, $id = null)
    {
        $this->assertCollectionOf($fields, Text::class);
        $this->block_id = $id;
        $this->text = $text;
        $this->fields = $fields;
        $this->accessory = $accessory;
    }

    /**
     * @param string $text
     * @param null $fields
     * @param Element|null $accessory
     * @param null $id
     * @return $this
     * @throws ItemMustBeInstanceOf
     */
    public static function markdown(string $text, $fields = null, BlockElement $accessory = null, $id = null)
    {
        return new static(Text::markdown($text), $fields, $accessory, $id);
    }
}