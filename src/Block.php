<?php

namespace App\Slack;

use Slack\Block\Button;
use Slack\Block\CombineWithContext;
use Slack\Block\Context;
use Slack\Block\Divider;
use Slack\Confirm;

class Block
{
    public static function context(CombineWithContext ...$elements)
    {
        return Context::make(...$elements);
    }

    public static function button(string $text, $url = null, $value = null, $style = null, Confirm $confirm = null, string $id = null)
    {
        return Button::make($text, $url, $value, $style, $confirm, $id);
    }

    public static function divider($blockId = null)
    {
        return Divider::make($blockId);
    }
}