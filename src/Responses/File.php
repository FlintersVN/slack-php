<?php

namespace Slack\Responses;

class File
{
    public $id;

    public $created;

    public $timestamp;

    public $name;

    public $title;

    public $mimetype;

    public $filetype;

    public $pretty_type;

    public $user;

    public $editable;

    public $size;

    public $mode;

    public $is_external;

    public $external_type;

    public $is_public;

    public $public_url_shared;

    public $display_as_bot;

    public $username;

    public $url_private;

    public $url_private_download;

    public $thumb_64;

    public $thumb_80;

    public $thumb_360;

    public $thumb_360_w;

    public $thumb_360_h;

    public $thumb_160;

    public $thumb_360_gif;

    public $image_exif_rotation;

    public $original_w;

    public $original_h;

    public $deanimate_gif;

    public $pjpeg;

    public $permalink;

    public $permalink_public;

    public $comments_count;

    public $is_starred;

    public $shares;

    public $channels = [];

    public $groups = [];

    public $ims = [];

    public $has_rich_preview = false;

    public static function fromArray($attributes)
    {
        $instance = new static;

        foreach ($attributes as $key => $attribute) {
            $instance->{$key} = $attribute;
        }

        return $instance;
    }
}