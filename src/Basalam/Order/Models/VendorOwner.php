<?php

namespace Basalam\Order\Models;

/**
 * Vendor owner model
 */
class VendorOwner implements \JsonSerializable
{
    private ?int $id;
    private ?string $hashId;
    private ?string $name;
    private ?VendorOwnerAvatar $avatar;
    private ?City $city;

    public function __construct(
        ?int               $id = null,
        ?string            $hashId = null,
        ?string            $name = null,
        ?VendorOwnerAvatar $avatar = null,
        ?City              $city = null
    )
    {
        $this->id = $id;
        $this->hashId = $hashId;
        $this->name = $name;
        $this->avatar = $avatar;
        $this->city = $city;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['hash_id'] ?? null,
            $data['name'] ?? null,
            isset($data['avatar']) ? VendorOwnerAvatar::fromArray($data['avatar']) : null,
            isset($data['city']) ? City::fromArray($data['city']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->hashId !== null) $result['hash_id'] = $this->hashId;
        if ($this->name !== null) $result['name'] = $this->name;
        if ($this->avatar !== null) $result['avatar'] = $this->avatar->toArray();
        if ($this->city !== null) $result['city'] = $this->city->toArray();
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHashId(): ?string
    {
        return $this->hashId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAvatar(): ?VendorOwnerAvatar
    {
        return $this->avatar;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}