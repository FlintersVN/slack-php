<?php

namespace Slack\Exceptions;

use InvalidArgumentException;

class InvalidFilePathException extends InvalidArgumentException
{
    public static function cannotBeRead($path)
    {
        return new static("The file path {$path} is non-exists or cannot be read.");
    }
}