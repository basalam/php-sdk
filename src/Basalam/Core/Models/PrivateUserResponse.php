<?php

namespace Basalam\Core\Models;

class PrivateUserResponse implements \JsonSerializable
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
    public ?string $email;
    public ?string $birthday;
    public ?string $national_code;
    public ?string $mobile;
    public ?string $credit_card_number;
    public ?string $credit_card_owner;
    public ?string $foreign_citizen_code;
    public ?string $user_sheba_number;
    public ?string $user_sheba_owner;
    public ?string $bank_information;
    public ?string $bank_information_owner;
    public ?MarkedTypeResponse $info_verification_status;
    public ?int $referrer_user_id;

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
        $model->email = $data['email'] ?? null;
        $model->birthday = $data['birthday'] ?? null;
        $model->national_code = $data['national_code'] ?? null;
        $model->mobile = $data['mobile'] ?? null;
        $model->credit_card_number = $data['credit_card_number'] ?? null;
        $model->credit_card_owner = $data['credit_card_owner'] ?? null;
        $model->foreign_citizen_code = $data['foreign_citizen_code'] ?? null;
        $model->user_sheba_number = $data['user_sheba_number'] ?? null;
        $model->user_sheba_owner = $data['user_sheba_owner'] ?? null;
        $model->bank_information = $data['bank_information'] ?? null;
        $model->bank_information_owner = $data['bank_information_owner'] ?? null;
        $model->info_verification_status = isset($data['info_verification_status'])
            ? MarkedTypeResponse::fromArray($data['info_verification_status'])
            : null;
        $model->referrer_user_id = $data['referrer_user_id'] ?? null;
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
            'email' => $this->email,
            'birthday' => $this->birthday,
            'national_code' => $this->national_code,
            'mobile' => $this->mobile,
            'credit_card_number' => $this->credit_card_number,
            'credit_card_owner' => $this->credit_card_owner,
            'foreign_citizen_code' => $this->foreign_citizen_code,
            'user_sheba_number' => $this->user_sheba_number,
            'user_sheba_owner' => $this->user_sheba_owner,
            'bank_information' => $this->bank_information,
            'bank_information_owner' => $this->bank_information_owner,
            'info_verification_status' => $this->info_verification_status?->toArray(),
            'referrer_user_id' => $this->referrer_user_id,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}