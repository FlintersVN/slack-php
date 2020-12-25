<?php

namespace Slack;

use GuzzleHttp\Client as HttpClient;
use Slack\Block\Element as BlockElement;
use Slack\Responses\File as FileResponse;
use Illuminate\Support\Collection;

/**
 * @mixin HttpClient
 */
class Client
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function postMessage(Message $message)
    {
        $optionalFields = array_filter([
            'icon_emoji' => $message->icon,
            'icon_url' => $message->image,
            'link_names' => $message->linkNames,
            'unfurl_links' => $message->unfurlLinks,
            'unfurl_media' => $message->unfurlMedia,
            'username' => $message->username,
        ]);

        $response = $this->post('chat.postMessage', [
            'json' => array_merge([
                'token' => $this->token,
                'channel' => $message->channel,
                'text' => $message->text,
                'blocks' => $this->blocks($message),
                'attachments' => $this->attachments($message)
            ], $optionalFields)
        ]);

        return json_decode($response->getBody()->getContents());
    }

    protected function blocks(Message $message)
    {
        return Collection::make($message->blocks)
            ->map(function (BlockElement $block) {
                return $block->toArray();
            })
            ->all();
    }

    public function uploadFile(File $file)
    {
        $response = $this->post('files.upload', $this->prepareOptionsForUploading($file));

        $json = json_decode($response->getBody()->getContents(), $asArray = true);

        if ($json['ok']) {
            return FileResponse::fromArray($json['file']);
        }

        return false;
    }

    protected function prepareOptionsForUploading(File $file)
    {
        $data = array_filter([
            'token' => $file->token ?: $this->token,
            'title' => $file->title,
            'initial_comment' => $file->initial_comment,
            'channels' => $file->channels,
            'content' => $file->content,
            'filename' => $file->filename,
            'file' => $file->file,
            'filetype' => $file->filetype,
            'thread_ts' => $file->thread_ts,
        ]);

        return $file->file
            ? ['multipart' => $this->toMultipart($data)]
            : ['form_params' => $data];
    }

    protected function toMultipart($attributes)
    {
        return array_map(function ($value, $key) {
            return [
                'name' => $key,
                'contents' => $value,
            ];
        }, $attributes, array_keys($attributes));
    }

    public function __call($name, $arguments)
    {
        return $this->guzzle()->$name(...$arguments);
    }

    public function guzzle()
    {
        return new HttpClient([
            'base_uri' => 'https://slack.com/api/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ],
        ]);
    }

    /**
     * Format the message's attachments.
     *
     * @param Message $message
     * @return array
     */
    protected function attachments(Message $message)
    {
        return Collection::make($message->attachments)->map(function (Attachment $attachment) use ($message) {
            return array_filter([
                'actions' => $attachment->actions,
                'author_icon' => $attachment->authorIcon,
                'author_link' => $attachment->authorLink,
                'author_name' => $attachment->authorName,
                'color' => $attachment->color,
                'fallback' => $attachment->fallback,
                'fields' => $this->fields($attachment),
                'footer' => $attachment->footer,
                'footer_icon' => $attachment->footerIcon,
                'image_url' => $attachment->imageUrl,
                'mrkdwn_in' => $attachment->markdown,
                'pretext' => $attachment->pretext,
                'text' => $attachment->content,
                'thumb_url' => $attachment->thumbUrl,
                'title' => $attachment->title,
                'title_link' => $attachment->url,
                'ts' => $attachment->timestamp,
            ]);
        })->all();
    }

    /**
     * Format the attachment's fields.
     *
     * @param Attachment $attachment
     * @return array
     */
    protected function fields(Attachment $attachment)
    {
        return Collection::make($attachment->fields)->map(function ($value, $key) {
            if ($value instanceof AttachmentField) {
                return $value->toArray();
            }

            return ['title' => $key, 'value' => $value, 'short' => true];
        })->values()->all();
    }
}