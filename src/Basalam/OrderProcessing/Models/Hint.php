<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Hint model.
 */
class Hint implements JsonSerializable
{
    private string $title;
    private ?string $text;
    private ?array $actions;

    public function __construct(
        string  $title,
        ?string $text = null,
        ?array  $actions = null
    )
    {
        $this->title = $title;
        $this->text = $text;
        $this->actions = $actions;
    }

    public static function fromArray(array $data): self
    {
        $actions = null;
        if (isset($data['actions'])) {
            $actions = array_map(fn($action) => Action::fromArray($action), $data['actions']);
        }

        return new self(
            $data['title'],
            $data['text'] ?? null,
            $actions
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'actions' => $this->actions ? array_map(fn($action) => $action->toArray(), $this->actions) : null,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}