<?php

namespace Slack;

class Markdown extends Text
{
    public static function bold(string $text)
    {
        return sprintf('*%s*', $text);
    }

    public static function here()
    {
        return '<!here>';
    }

    public static function mentionChannel()
    {
        return '<!channel>';
    }

    public static function everyone()
    {
        return '<!everyone>';
    }

    public static function italic(string $text)
    {
        return sprintf('_%s_', $text);
    }

    public static function strike(string $text)
    {
        return sprintf('~%s~', $text);
    }

    public static function quote(string $text)
    {
        return sprintf('>%s', $text);
    }

    public static function inlineCode(string $text)
    {
        return sprintf('`%s`', $text);
    }

    public static function codeBlock(string $code)
    {
        return sprintf('```%s```', $code);
    }

    public static function lists(array $items)
    {
        return implode("\n", array_map(function ($item) {
            return '- ' . $item;
        }, $items));
    }

    public static function link(string $url, string $text = null)
    {
        $text = $text ?: $url;

        return sprintf('<%s|%s>', $url, $text);
    }

    public static function multiLines(array $lines)
    {
        return implode("\n", $lines);
    }
}