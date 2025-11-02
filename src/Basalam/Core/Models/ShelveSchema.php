<?php

namespace Basalam\Core\Models;

class ShelveSchema implements \JsonSerializable
{
    public string $title;
    public ?string $description;
    public ?int $file_id;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'] ?? null;
        $this->file_id = $data['file_id'] ?? null;
    }

    public function toArray(): array
    {
        $result = [
            'title' => $this->title,
        ];

        if ($this->description !== null) $result['description'] = $this->description;
        if ($this->file_id !== null) $result['file_id'] = $this->file_id;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
