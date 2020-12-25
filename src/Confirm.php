<?php

namespace Slack;

class Confirm extends Element
{
    /**
     * @var PlainText
     */
    public $title;

    /**
     * @var Text
     */
    public $text;

    /**
     * @var PlainText
     */
    public $confirm;

    /**
     * @var PlainText
     */
    public $deny;

    public function __construct(PlainText $title, Text $text, PlainText $confirm, PlainText $deny)
    {
        $this->title = $title;
        $this->text = $text;
        $this->confirm = $confirm;
        $this->deny = $deny;
    }

    public static function plain(string $title, string $text, string $confirm, string $deny)
    {
        return new static(
            PlainText::make($title),
            PlainText::make($text),
            PlainText::make($confirm),
            PlainText::make($deny)
        );
    }

    public static function markdown(string $title, string $text, string $confirm, string $deny)
    {
        return new static(
            PlainText::make($title),
            Text::markdown($text),
            PlainText::make($confirm),
            PlainText::make($deny)
        );
    }
}