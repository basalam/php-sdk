<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Customer model.
 */
class Customer implements JsonSerializable
{
    private Recipient $recipient;
    private ?City $city;
    private User $user;

    public function __construct(Recipient $recipient, User $user, ?City $city = null)
    {
        $this->recipient = $recipient;
        $this->user = $user;
        $this->city = $city;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            Recipient::fromArray($data['recipient']),
            User::fromArray($data['user']),
            isset($data['city']) ? City::fromArray($data['city']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'recipient' => $this->recipient->toArray(),
            'city' => $this->city?->toArray(),
            'user' => $this->user->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}