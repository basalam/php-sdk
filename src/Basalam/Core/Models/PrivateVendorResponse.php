<?php

namespace Basalam\Core\Models;

/**
 * PrivateVendorResponse model (vendor details with private fields).
 */
class PrivateVendorResponse implements \JsonSerializable
{
    private int $id;
    private string $identifier;
    private string $title;
    private ?array $logo;
    private ?array $covers;
    private ?array $availableCities;
    private ?string $summary;
    private ?array $status;
    private ?array $city;
    private ?array $categoryType;
    private ?array $user;
    private bool $isActive;
    private ?string $notice;
    private ?array $gallery;
    private ?int $productCount;
    private ?int $freeShippingToIran;
    private ?int $freeShippingToSameCity;
    private ?string $aboutYourLife;
    private ?string $aboutYourPlace;
    private ?string $worthBuy;
    private ?string $telegramId;
    private ?string $telegramChannel;
    private ?string $instagram;
    private ?string $eitaa;
    private ?int $orderCount;
    private ?string $lastActivity;
    private string $createdAt;
    private ?string $elapsedTimeFromCreation;
    private ?int $score;
    private ?array $video;
    private ?array $shippingMethods;
    private ?array $productSortType;
    private ?array $homeTabSettings;
    private ?int $shippingVersion;
    private string $mobile;
    private ?string $address;
    private ?string $shebaNumber;
    private ?string $shebaOwner;
    private ?array $shebaBank;
    private ?bool $shebaVerified;
    private ?string $creditCardNumber;
    private ?string $postalCode;
    private ?array $licenses;
    private ?string $email;
    private ?string $secondaryTel;
    private ?bool $isMentor;
    private ?array $signUpJourneyState;
    private ?bool $signUpJourneyIsDone;
    private ?array $infoVerificationStatus;
    private ?string $referrerUser;
    private ?string $activatedAt;
    private ?array $legalData;
    private ?array $geoLocation;

    public function __construct(
        int $id,
        string $identifier,
        string $title,
        ?array $logo,
        ?array $covers,
        ?array $availableCities,
        ?string $summary,
        ?array $status,
        ?array $city,
        ?array $categoryType,
        ?array $user,
        bool $isActive,
        ?string $notice,
        ?array $gallery,
        ?int $productCount,
        ?int $freeShippingToIran,
        ?int $freeShippingToSameCity,
        ?string $aboutYourLife,
        ?string $aboutYourPlace,
        ?string $worthBuy,
        ?string $telegramId,
        ?string $telegramChannel,
        ?string $instagram,
        ?string $eitaa,
        ?int $orderCount,
        ?string $lastActivity,
        string $createdAt,
        ?string $elapsedTimeFromCreation,
        ?int $score,
        ?array $video,
        ?array $shippingMethods,
        ?array $productSortType,
        ?array $homeTabSettings,
        ?int $shippingVersion,
        string $mobile,
        ?string $address,
        ?string $shebaNumber,
        ?string $shebaOwner,
        ?array $shebaBank,
        ?bool $shebaVerified,
        ?string $creditCardNumber,
        ?string $postalCode,
        ?array $licenses,
        ?string $email,
        ?string $secondaryTel,
        ?bool $isMentor,
        ?array $signUpJourneyState,
        ?bool $signUpJourneyIsDone,
        ?array $infoVerificationStatus,
        ?string $referrerUser,
        ?string $activatedAt,
        ?array $legalData,
        ?array $geoLocation
    ) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->title = $title;
        $this->logo = $logo;
        $this->covers = $covers;
        $this->availableCities = $availableCities;
        $this->summary = $summary;
        $this->status = $status;
        $this->city = $city;
        $this->categoryType = $categoryType;
        $this->user = $user;
        $this->isActive = $isActive;
        $this->notice = $notice;
        $this->gallery = $gallery;
        $this->productCount = $productCount;
        $this->freeShippingToIran = $freeShippingToIran;
        $this->freeShippingToSameCity = $freeShippingToSameCity;
        $this->aboutYourLife = $aboutYourLife;
        $this->aboutYourPlace = $aboutYourPlace;
        $this->worthBuy = $worthBuy;
        $this->telegramId = $telegramId;
        $this->telegramChannel = $telegramChannel;
        $this->instagram = $instagram;
        $this->eitaa = $eitaa;
        $this->orderCount = $orderCount;
        $this->lastActivity = $lastActivity;
        $this->createdAt = $createdAt;
        $this->elapsedTimeFromCreation = $elapsedTimeFromCreation;
        $this->score = $score;
        $this->video = $video;
        $this->shippingMethods = $shippingMethods;
        $this->productSortType = $productSortType;
        $this->homeTabSettings = $homeTabSettings;
        $this->shippingVersion = $shippingVersion;
        $this->mobile = $mobile;
        $this->address = $address;
        $this->shebaNumber = $shebaNumber;
        $this->shebaOwner = $shebaOwner;
        $this->shebaBank = $shebaBank;
        $this->shebaVerified = $shebaVerified;
        $this->creditCardNumber = $creditCardNumber;
        $this->postalCode = $postalCode;
        $this->licenses = $licenses;
        $this->email = $email;
        $this->secondaryTel = $secondaryTel;
        $this->isMentor = $isMentor;
        $this->signUpJourneyState = $signUpJourneyState;
        $this->signUpJourneyIsDone = $signUpJourneyIsDone;
        $this->infoVerificationStatus = $infoVerificationStatus;
        $this->referrerUser = $referrerUser;
        $this->activatedAt = $activatedAt;
        $this->legalData = $legalData;
        $this->geoLocation = $geoLocation;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['identifier'],
            $data['title'],
            $data['logo'] ?? null,
            $data['covers'] ?? null,
            $data['available_cities'] ?? null,
            $data['summary'] ?? null,
            $data['status'] ?? null,
            $data['city'] ?? null,
            $data['category_type'] ?? null,
            $data['user'] ?? null,
            $data['is_active'],
            $data['notice'] ?? null,
            $data['gallery'] ?? null,
            $data['product_count'] ?? null,
            $data['free_shipping_to_iran'] ?? null,
            $data['free_shipping_to_same_city'] ?? null,
            $data['about_your_life'] ?? null,
            $data['about_your_place'] ?? null,
            $data['worth_buy'] ?? null,
            $data['telegram_id'] ?? null,
            $data['telegram_channel'] ?? null,
            $data['instagram'] ?? null,
            $data['eitaa'] ?? null,
            $data['order_count'] ?? null,
            $data['last_activity'] ?? null,
            $data['created_at'],
            $data['elapsed_time_from_creation'] ?? null,
            $data['score'] ?? null,
            $data['video'] ?? null,
            $data['shipping_methods'] ?? null,
            $data['product_sort_type'] ?? null,
            $data['home_tab_settings'] ?? null,
            $data['shipping_version'] ?? null,
            $data['mobile'],
            $data['address'] ?? null,
            $data['sheba_number'] ?? null,
            $data['sheba_owner'] ?? null,
            $data['sheba_bank'] ?? null,
            $data['sheba_verified'] ?? null,
            $data['credit_card_number'] ?? null,
            $data['postal_code'] ?? null,
            $data['licenses'] ?? null,
            $data['email'] ?? null,
            $data['secondary_tel'] ?? null,
            $data['is_mentor'] ?? null,
            $data['sign_up_journey_state'] ?? null,
            $data['sign_up_journey_is_done'] ?? null,
            $data['info_verification_status'] ?? null,
            $data['referrer_user'] ?? null,
            $data['activated_at'] ?? null,
            $data['legal_data'] ?? null,
            $data['geo_location'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['identifier'] = $this->identifier;
        $result['title'] = $this->title;
        $result['logo'] = $this->logo;
        $result['covers'] = $this->covers;
        $result['available_cities'] = $this->availableCities;
        $result['summary'] = $this->summary;
        $result['status'] = $this->status;
        $result['city'] = $this->city;
        $result['category_type'] = $this->categoryType;
        $result['user'] = $this->user;
        $result['is_active'] = $this->isActive;
        $result['notice'] = $this->notice;
        $result['gallery'] = $this->gallery;
        if ($this->productCount !== null) {
            $result['product_count'] = $this->productCount;
        }
        $result['free_shipping_to_iran'] = $this->freeShippingToIran;
        $result['free_shipping_to_same_city'] = $this->freeShippingToSameCity;
        $result['about_your_life'] = $this->aboutYourLife;
        $result['about_your_place'] = $this->aboutYourPlace;
        $result['worth_buy'] = $this->worthBuy;
        if ($this->telegramId !== null) {
            $result['telegram_id'] = $this->telegramId;
        }
        if ($this->telegramChannel !== null) {
            $result['telegram_channel'] = $this->telegramChannel;
        }
        if ($this->instagram !== null) {
            $result['instagram'] = $this->instagram;
        }
        if ($this->eitaa !== null) {
            $result['eitaa'] = $this->eitaa;
        }
        if ($this->orderCount !== null) {
            $result['order_count'] = $this->orderCount;
        }
        if ($this->lastActivity !== null) {
            $result['last_activity'] = $this->lastActivity;
        }
        $result['created_at'] = $this->createdAt;
        if ($this->elapsedTimeFromCreation !== null) {
            $result['elapsed_time_from_creation'] = $this->elapsedTimeFromCreation;
        }
        if ($this->score !== null) {
            $result['score'] = $this->score;
        }
        $result['video'] = $this->video;
        $result['shipping_methods'] = $this->shippingMethods;
        $result['product_sort_type'] = $this->productSortType;
        $result['home_tab_settings'] = $this->homeTabSettings;
        if ($this->shippingVersion !== null) {
            $result['shipping_version'] = $this->shippingVersion;
        }
        $result['mobile'] = $this->mobile;
        $result['address'] = $this->address;
        $result['sheba_number'] = $this->shebaNumber;
        $result['sheba_owner'] = $this->shebaOwner;
        $result['sheba_bank'] = $this->shebaBank;
        $result['sheba_verified'] = $this->shebaVerified;
        $result['credit_card_number'] = $this->creditCardNumber;
        $result['postal_code'] = $this->postalCode;
        $result['licenses'] = $this->licenses;
        $result['email'] = $this->email;
        $result['secondary_tel'] = $this->secondaryTel;
        $result['is_mentor'] = $this->isMentor;
        $result['sign_up_journey_state'] = $this->signUpJourneyState;
        $result['sign_up_journey_is_done'] = $this->signUpJourneyIsDone;
        $result['info_verification_status'] = $this->infoVerificationStatus;
        $result['referrer_user'] = $this->referrerUser;
        $result['activated_at'] = $this->activatedAt;
        if ($this->legalData !== null) {
            $result['legal_data'] = $this->legalData;
        }
        if ($this->geoLocation !== null) {
            $result['geo_location'] = $this->geoLocation;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLogo(): ?array
    {
        return $this->logo;
    }

    public function getCovers(): ?array
    {
        return $this->covers;
    }

    public function getAvailableCities(): ?array
    {
        return $this->availableCities;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function getCity(): ?array
    {
        return $this->city;
    }

    public function getCategoryType(): ?array
    {
        return $this->categoryType;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getNotice(): ?string
    {
        return $this->notice;
    }

    public function getGallery(): ?array
    {
        return $this->gallery;
    }

    public function getProductCount(): ?int
    {
        return $this->productCount;
    }

    public function getFreeShippingToIran(): ?int
    {
        return $this->freeShippingToIran;
    }

    public function getFreeShippingToSameCity(): ?int
    {
        return $this->freeShippingToSameCity;
    }

    public function getAboutYourLife(): ?string
    {
        return $this->aboutYourLife;
    }

    public function getAboutYourPlace(): ?string
    {
        return $this->aboutYourPlace;
    }

    public function getWorthBuy(): ?string
    {
        return $this->worthBuy;
    }

    public function getTelegramId(): ?string
    {
        return $this->telegramId;
    }

    public function getTelegramChannel(): ?string
    {
        return $this->telegramChannel;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function getEitaa(): ?string
    {
        return $this->eitaa;
    }

    public function getOrderCount(): ?int
    {
        return $this->orderCount;
    }

    public function getLastActivity(): ?string
    {
        return $this->lastActivity;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getElapsedTimeFromCreation(): ?string
    {
        return $this->elapsedTimeFromCreation;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function getVideo(): ?array
    {
        return $this->video;
    }

    public function getShippingMethods(): ?array
    {
        return $this->shippingMethods;
    }

    public function getProductSortType(): ?array
    {
        return $this->productSortType;
    }

    public function getHomeTabSettings(): ?array
    {
        return $this->homeTabSettings;
    }

    public function getShippingVersion(): ?int
    {
        return $this->shippingVersion;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getShebaNumber(): ?string
    {
        return $this->shebaNumber;
    }

    public function getShebaOwner(): ?string
    {
        return $this->shebaOwner;
    }

    public function getShebaBank(): ?array
    {
        return $this->shebaBank;
    }

    public function getShebaVerified(): ?bool
    {
        return $this->shebaVerified;
    }

    public function getCreditCardNumber(): ?string
    {
        return $this->creditCardNumber;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getLicenses(): ?array
    {
        return $this->licenses;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getSecondaryTel(): ?string
    {
        return $this->secondaryTel;
    }

    public function getIsMentor(): ?bool
    {
        return $this->isMentor;
    }

    public function getSignUpJourneyState(): ?array
    {
        return $this->signUpJourneyState;
    }

    public function getSignUpJourneyIsDone(): ?bool
    {
        return $this->signUpJourneyIsDone;
    }

    public function getInfoVerificationStatus(): ?array
    {
        return $this->infoVerificationStatus;
    }

    public function getReferrerUser(): ?string
    {
        return $this->referrerUser;
    }

    public function getActivatedAt(): ?string
    {
        return $this->activatedAt;
    }

    public function getLegalData(): ?array
    {
        return $this->legalData;
    }

    public function getGeoLocation(): ?array
    {
        return $this->geoLocation;
    }
}
