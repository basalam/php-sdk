<?php

namespace Basalam\Core\Models;

class ResultResponse implements \JsonSerializable
{
    public ?bool $result;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->result = $data['result'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}