<?php

namespace Slack;

use Slack\Exceptions\InvalidFilePathException;

class File implements ToArray
{
    use ConditionallyToArray;

    public $title;

    public $initial_comment;

    /**
     * @var Comma-separated list of channel names or IDs where the file will be shared.
     */
    public $channels;

    public $content;

    public $filename;

    public $filetype;

    public $thread_ts;

    public $token;

    public $file;

    public static function fromPath($path)
    {
        $file = new static;

        if (! is_file($path) || ! is_readable($path)) {
            throw InvalidFilePathException::cannotBeRead($path);
        }

        $file->file = fopen($path, 'r');
        return $file;
    }

    public static function content($content)
    {
        $file = new static;
        $file->content = $content;
        return $file;
    }

    public function toArray(): array
    {
        return $this->filterNullValues($this->propertiesAsArray());
    }
}