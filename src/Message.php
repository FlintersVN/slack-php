<?php

namespace Slack;

use Slack\Block\Element as BlockElement;
use Slack\Block\Section;

class Message extends Element
{
    public $text;

    public $blocks;

    public $attachments;

    public $threadTs;

    public $mrkdwn = true;

    public $icon;

    public $image;

    public $linkNames;

    public $unfurlLinks;

    public $unfurlMedia;

    public $username;

    public $channel;

    public $content;

    public function __construct(string $text = '', $blocks = null, $attachments = null, $threadTs = null, $mrkdwn = true)
    {
        $this->text = $text;
        $this->blocks = $blocks;
        $this->attachments = $attachments;
        $this->threadTs = $threadTs;
        $this->mrkdwn = $mrkdwn;
    }

    /**
     * @param array $blocks
     * @return $this
     */
    public function blocks($blocks = [])
    {
        $this->blocks = is_array($blocks) ? $blocks : func_get_args();

        return $this;
    }

    /**
     * @param Text $text
     * @param callable|null $callback
     * @return Message
     * @throws Exceptions\ItemMustBeInstanceOf
     */
    public function section(Text $text, callable $callback =  null)
    {
        $this->blocks[] = $block = new Section($text);

        if ($callback) {
            $callback($block);
        }

        return $this;
    }

    public function toThread(string $thread)
    {
        $this->threadTs = $thread;

        return $this;
    }

    public function addBlock(BlockElement $element)
    {
        $this->blocks[] = $element;

        return $this;
    }

    public function addAttachment(Attachment $attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    public function attachment(callable $callback)
    {
        $this->attachments[] = $attachment = new Attachment();

        $callback($attachment);

        return $this;
    }

    public function withoutMarkdown()
    {
        $this->mrkdwn = false;
        return $this;
    }
}