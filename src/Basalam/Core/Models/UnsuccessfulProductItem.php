<?php

namespace Basalam\Core\Models;

class UnsuccessfulProductItem implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?int $price;
    public ?ImageResponse $photo;
    public ?int $inventory;
    public ?int $primary_price;
    public ?int $preparation_day;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->price = $data['price'] ?? null;
        $model->photo = isset($data['photo'])
            ? ImageResponse::fromArray($data['photo'])
            : null;
        $model->inventory = $data['inventory'] ?? null;
        $model->primary_price = $data['primary_price'] ?? null;
        $model->preparation_day = $data['preparation_day'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'photo' => $this->photo?->toArray(),
            'inventory' => $this->inventory,
            'primary_price' => $this->primary_price,
            'preparation_day' => $this->preparation_day,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}