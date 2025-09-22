<?php

namespace Basalam\Core\Models;

class BulkActionItem implements \JsonSerializable
{
    public string $field;
    public ?int $action;
    public ?int $value;

    public function __construct(array $data)
    {
        $this->field = $data['field'];
        $this->action = $data['action'] ?? null;
        $this->value = $data['value'] ?? null;
    }

    public function toArray(): array
    {
        $result = [
            'field' => $this->field,
        ];
        if ($this->action !== null) $result['action'] = $this->action;
        if ($this->value !== null) $result['value'] = $this->value;
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}