<?php

namespace Basalam\Order\Models;

/**
 * Response model for basket endpoint
 */
class BasketResponse implements \JsonSerializable
{
    private ?int $id;
    private ?int $itemCount;
    private ?bool $showRecipientMobile;
    private ?string $deliveryMethod;
    private ?BasketCosts $costs;
    private ?array $errors;
    private ?int $errorCount;
    private ?array $coupon;
    private ?string $optionCode;
    private ?BasketAddress $address;
    private ?array $origins;
    private ?array $vendors;

    public function __construct(
        ?int           $id = null,
        ?int           $itemCount = null,
        ?bool          $showRecipientMobile = null,
        ?string        $deliveryMethod = null,
        ?BasketCosts   $costs = null,
        ?array         $errors = null,
        ?int           $errorCount = null,
        ?array         $coupon = null,
        ?string        $optionCode = null,
        ?BasketAddress $address = null,
        ?array         $origins = null,
        ?array         $vendors = null
    )
    {
        $this->id = $id;
        $this->itemCount = $itemCount;
        $this->showRecipientMobile = $showRecipientMobile;
        $this->deliveryMethod = $deliveryMethod;
        $this->costs = $costs;
        $this->errors = $errors;
        $this->errorCount = $errorCount;
        $this->coupon = $coupon;
        $this->optionCode = $optionCode;
        $this->address = $address;
        $this->origins = $origins;
        $this->vendors = $vendors;
    }

    public static function fromArray(array $data): self
    {
        $origins = null;
        if (isset($data['origins'])) {
            $origins = array_map(
                fn($origin) => is_array($origin) ? Origin::fromArray($origin) : $origin,
                $data['origins']
            );
        }

        $vendors = null;
        if (isset($data['vendors'])) {
            $vendors = array_map(
                fn($vendor) => is_array($vendor) ? BasketVendor::fromArray($vendor) : $vendor,
                $data['vendors']
            );
        }

        return new self(
            $data['id'] ?? null,
            $data['item_count'] ?? null,
            $data['show_recipient_mobile'] ?? null,
            $data['delivery_method'] ?? null,
            isset($data['costs']) ? BasketCosts::fromArray($data['costs']) : null,
            $data['errors'] ?? null,
            $data['error_count'] ?? null,
            $data['coupon'] ?? null,
            $data['option_code'] ?? null,
            isset($data['address']) ? BasketAddress::fromArray($data['address']) : null,
            $origins,
            $vendors
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->itemCount !== null) {
            $result['item_count'] = $this->itemCount;
        }
        if ($this->showRecipientMobile !== null) {
            $result['show_recipient_mobile'] = $this->showRecipientMobile;
        }
        if ($this->deliveryMethod !== null) {
            $result['delivery_method'] = $this->deliveryMethod;
        }
        if ($this->costs !== null) {
            $result['costs'] = $this->costs->toArray();
        }
        if ($this->errors !== null) {
            $result['errors'] = $this->errors;
        }
        if ($this->errorCount !== null) {
            $result['error_count'] = $this->errorCount;
        }
        if ($this->coupon !== null) {
            $result['coupon'] = $this->coupon;
        }
        if ($this->optionCode !== null) {
            $result['option_code'] = $this->optionCode;
        }
        if ($this->address !== null) {
            $result['address'] = $this->address->toArray();
        }
        if ($this->origins !== null) {
            $result['origins'] = array_map(
                fn($origin) => $origin instanceof Origin ? $origin->toArray() : $origin,
                $this->origins
            );
        }
        if ($this->vendors !== null) {
            $result['vendors'] = array_map(
                fn($vendor) => $vendor instanceof BasketVendor ? $vendor->toArray() : $vendor,
                $this->vendors
            );
        }

        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemCount(): ?int
    {
        return $this->itemCount;
    }

    public function showRecipientMobile(): ?bool
    {
        return $this->showRecipientMobile;
    }

    public function getDeliveryMethod(): ?string
    {
        return $this->deliveryMethod;
    }

    public function getCosts(): ?BasketCosts
    {
        return $this->costs;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function getErrorCount(): ?int
    {
        return $this->errorCount;
    }

    public function getCoupon(): ?array
    {
        return $this->coupon;
    }

    public function getOptionCode(): ?string
    {
        return $this->optionCode;
    }

    public function getAddress(): ?BasketAddress
    {
        return $this->address;
    }

    public function getOrigins(): ?array
    {
        return $this->origins;
    }

    public function getVendors(): ?array
    {
        return $this->vendors;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}