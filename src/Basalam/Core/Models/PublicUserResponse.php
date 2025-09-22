<?php

namespace Basalam\Core\Models;

class PublicUserResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $hash_id;
    public ?string $username;
    public ?string $name;
    public ?ImageResponse $avatar;
    public ?MarkedTypeResponse $marked_type;
    public ?int $user_follower_count;
    public ?int $user_following_count;
    public ?GenderResponse $gender;
    public ?string $bio;
    public ?CityResponse $city;
    public ?string $created_at;
    public ?string $last_activity;
    public ?ReferralJourneyResponse $referral_journey_enum;
    public ?bool $is_banned_in_social;
    public ?array $ban_user;
    public ?PublicVendorSimpleResponse $vendor;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->hash_id = $data['hash_id'] ?? null;
        $model->username = $data['username'] ?? null;
        $model->name = $data['name'] ?? null;
        $model->avatar = isset($data['avatar'])
            ? ImageResponse::fromArray($data['avatar'])
            : null;
        $model->marked_type = isset($data['marked_type'])
            ? MarkedTypeResponse::fromArray($data['marked_type'])
            : null;
        $model->user_follower_count = $data['user_follower_count'] ?? null;
        $model->user_following_count = $data['user_following_count'] ?? null;
        $model->gender = isset($data['gender'])
            ? GenderResponse::fromArray($data['gender'])
            : null;
        $model->bio = $data['bio'] ?? null;
        $model->city = isset($data['city'])
            ? CityResponse::fromArray($data['city'])
            : null;
        $model->created_at = $data['created_at'] ?? null;
        $model->last_activity = $data['last_activity'] ?? null;
        $model->referral_journey_enum = isset($data['referral_journey_enum'])
            ? ReferralJourneyResponse::fromArray($data['referral_journey_enum'])
            : null;
        $model->is_banned_in_social = $data['is_banned_in_social'] ?? null;
        $model->ban_user = $data['ban_user'] ?? null;
        $model->vendor = isset($data['vendor'])
            ? PublicVendorSimpleResponse::fromArray($data['vendor'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'hash_id' => $this->hash_id,
            'username' => $this->username,
            'name' => $this->name,
            'avatar' => $this->avatar?->toArray(),
            'marked_type' => $this->marked_type?->toArray(),
            'user_follower_count' => $this->user_follower_count,
            'user_following_count' => $this->user_following_count,
            'gender' => $this->gender?->toArray(),
            'bio' => $this->bio,
            'city' => $this->city?->toArray(),
            'created_at' => $this->created_at,
            'last_activity' => $this->last_activity,
            'referral_journey_enum' => $this->referral_journey_enum?->toArray(),
            'is_banned_in_social' => $this->is_banned_in_social,
            'ban_user' => $this->ban_user,
            'vendor' => $this->vendor?->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}