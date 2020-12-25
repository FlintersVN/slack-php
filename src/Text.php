<?php

namespace Slack;

use Slack\Block\CombineWithContext;

class Text extends Element implements CombineWithContext
{
    const TYPE_PLAIN_TEXT = 'plain_text';

    const TYPE_MARKDOWN = 'mrkdwn';

    public $type;

    public $text;

    public $emoji;

    /**
     * @var null
     */
    public $verbatim;

    public function __construct(string $text, string $type = self::TYPE_PLAIN_TEXT, $emoji = null,  $verbatim = null)
    {
        $this->type = $type;
        $this->text = $text;
        $this->emoji = $emoji;
        $this->verbatim = $verbatim;
    }

    public static function plain(string $text)
    {
        return new static($text, static::TYPE_PLAIN_TEXT);
    }

    public static function markdown(string $markdown)
    {
        return new static($markdown, static::TYPE_MARKDOWN);
    }
}