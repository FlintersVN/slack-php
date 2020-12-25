<?php

namespace Slack\Block;

use Slack\Confirm;
use Slack\PlainText;

class Button extends Element
{
    const STYLE_PRIMARY = 'primary';

    const STYLE_DANGER = 'danger';

    public $type;

    public $text;

    public $action_id;

    public $url;

    public $value;

    public $style;

    public $confirm;

    public function __construct(PlainText $text, string $url = null, string $value = null, string $style = null, Confirm $confirm = null, string $id = null)
    {
        $this->type = 'button';
        $this->action_id = $id;
        $this->text = $text;
        $this->url = $url;
        $this->value = $value;
        $this->style = $style;
        $this->confirm = $confirm;
    }

    public static function primary($text, string $url = null, string $value = null, Confirm $confirm = null, $id = null)
    {
        return static::make($text, $url, $value, static::STYLE_PRIMARY, $confirm, $id);
    }

    public static function danger(string $id, $text, string $url = null, string $value = null, Confirm $confirm = null)
    {
        return static::make($text, $url, $value, static::STYLE_DANGER, $confirm, $id);
    }

    public static function default($text, string $url = null, string $value = null, Confirm $confirm = null, string $id = null)
    {
        return static::make($text, $url, $value, null, $confirm, $id,);
    }

    public static function make(string $text, $url = null, $value = null, $style = null, Confirm $confirm = null, string $id = null)
    {
        return new static(
            PlainText::make($text),
            $url,
            $value,
            $style,
            $confirm,
            $id
        );
    }
}