<?php

namespace Basalam\Chat\Models;

class MessageContent implements \JsonSerializable
{
    private ?array $links;
    private ?array $files;
    private ?string $text;
    private ?int $entityId;
    private ?LocationResource $location;
    private ?array $metadata;
    private ?array $replyMarkup;

    public function __construct(
        ?array            $links = null,
        ?array            $files = null,
        ?string           $text = null,
        ?int              $entityId = null,
        ?LocationResource $location = null,
        ?array            $metadata = null,
        ?array            $replyMarkup = null
    )
    {
        $this->links = $links;
        $this->files = $files;
        $this->text = $text;
        $this->entityId = $entityId;
        $this->location = $location;
        $this->metadata = $metadata;
        $this->replyMarkup = $replyMarkup;
    }

    public static function fromArray(array $data): self
    {
        $links = null;
        if (isset($data['links'])) {
            $links = [];
            foreach ($data['links'] as $link) {
                $links[] = MessageLink::fromArray($link);
            }
        }

        $files = null;
        if (isset($data['files'])) {
            $files = [];
            foreach ($data['files'] as $file) {
                $files[] = MessageFile::fromArray($file);
            }
        }

        $location = null;
        if (isset($data['location'])) {
            $location = LocationResource::fromArray($data['location']);
        }

        return new self(
            $links,
            $files,
            $data['text'] ?? null,
            $data['entity_id'] ?? null,
            $location,
            $data['metadata'] ?? null,
            $data['reply_markup'] ?? null
        );
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->links !== null) {
            $data['links'] = array_map(fn($link) => $link->toArray(), $this->links);
        }
        if ($this->files !== null) {
            $data['files'] = array_map(fn($file) => $file->toArray(), $this->files);
        }
        if ($this->text !== null) {
            $data['text'] = $this->text;
        }
        if ($this->entityId !== null) {
            $data['entity_id'] = $this->entityId;
        }
        if ($this->location !== null) {
            $data['location'] = $this->location->toArray();
        }
        if ($this->metadata !== null) {
            $data['metadata'] = $this->metadata;
        }
        if ($this->replyMarkup !== null) {
            $data['reply_markup'] = $this->replyMarkup;
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getLinks(): ?array
    {
        return $this->links;
    }

    public function getFiles(): ?array
    {
        return $this->files;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function getLocation(): ?LocationResource
    {
        return $this->location;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getReplyMarkup(): ?array
    {
        return $this->replyMarkup;
    }
}