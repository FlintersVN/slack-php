<?php

namespace Slack\Block;

use Slack\Confirm;
use Slack\PlainText;

class Datepicker extends Element
{
    public $type;

    public $action_id;

    public $placeholder;

    public $initial_date;

    public $confirm;

    public function __construct(string $id, PlainText $text = null, string $initial_date = null, Confirm $confirm = null)
    {
        $this->type = 'datepicker';
        $this->action_id = $id;
        $this->placeholder = $text;
        $this->initial_date = $initial_date;
        $this->confirm = $confirm;
    }

    public function make(string $id, string $text, string $initial_date = null, Confirm $confirm = null)
    {
        return new static($id, PlainText::make($text), $initial_date, $confirm);
    }
}