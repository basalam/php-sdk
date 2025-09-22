<?php

namespace Basalam\Chat\Models;

class MessageContent implements \JsonSerializable
{
    private array $links;
    private array $files;
    private ?string $text;
    private ?int $entityId;
    private ?LocationResource $location;

    public function __construct(
        array             $links = [],
        array             $files = [],
        ?string           $text = null,
        ?int              $entityId = null,
        ?LocationResource $location = null
    )
    {
        $this->links = $links;
        $this->files = $files;
        $this->text = $text;
        $this->entityId = $entityId;
        $this->location = $location;
    }

    public static function fromArray(array $data): self
    {
        $links = [];
        if (isset($data['links'])) {
            foreach ($data['links'] as $link) {
                $links[] = MessageLink::fromArray($link);
            }
        }

        $files = [];
        if (isset($data['files'])) {
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
            $location
        );
    }

    public function toArray(): array
    {
        $data = [
            'links' => array_map(fn($link) => $link->toArray(), $this->links),
            'files' => array_map(fn($file) => $file->toArray(), $this->files),
        ];

        if ($this->text !== null) {
            $data['text'] = $this->text;
        }
        if ($this->entityId !== null) {
            $data['entity_id'] = $this->entityId;
        }
        if ($this->location !== null) {
            $data['location'] = $this->location->toArray();
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getLinks(): array
    {
        return $this->links;
    }

    public function getFiles(): array
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
}