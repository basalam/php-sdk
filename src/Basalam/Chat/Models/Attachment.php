<?php

namespace Basalam\Chat\Models;

class Attachment implements \JsonSerializable
{
    private ?array $files;

    public function __construct(?array $files = null)
    {
        $this->files = $files;
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->files !== null) {
            $data['files'] = array_map(function ($file) {
                return $file instanceof AttachmentFile ? $file->toArray() : $file;
            }, $this->files);
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getFiles(): ?array
    {
        return $this->files;
    }
}