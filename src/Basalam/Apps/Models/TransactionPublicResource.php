<?php

namespace Basalam\Apps\Models;

use DateTime;

/**
 * TransactionPublicResource model.
 */
class TransactionPublicResource implements \JsonSerializable
{
    private ?string $hashId;
    private ?int $gatewayId;
    private ?string $referenceId;
    private ?int $amount;
    private ?string $description;
    private ?string $callbackUrl;
    private ?int $userId;
    private ?string $mobile;
    private ?array $methodsData;
    private ?TransactionStatusResource $status;
    private ?string $payUrl;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        ?string $hashId,
        ?int $gatewayId,
        ?string $referenceId,
        ?int $amount,
        ?string $description,
        ?string $callbackUrl,
        ?int $userId,
        ?string $mobile,
        ?array $methodsData,
        ?TransactionStatusResource $status,
        ?string $payUrl,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->hashId = $hashId;
        $this->gatewayId = $gatewayId;
        $this->referenceId = $referenceId;
        $this->amount = $amount;
        $this->description = $description;
        $this->callbackUrl = $callbackUrl;
        $this->userId = $userId;
        $this->mobile = $mobile;
        $this->methodsData = $methodsData;
        $this->status = $status;
        $this->payUrl = $payUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['hash_id'] ?? null,
            $data['gateway_id'] ?? null,
            $data['reference_id'] ?? null,
            $data['amount'] ?? null,
            $data['description'] ?? null,
            $data['callback_url'] ?? null,
            $data['user_id'] ?? null,
            $data['mobile'] ?? null,
            isset($data['methods_data']) ? array_map(fn($item) => TransactionMethodDataResource::fromArray($item), $data['methods_data']) : null,
            isset($data['status']) ? TransactionStatusResource::fromArray($data['status']) : null,
            $data['pay_url'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->hashId !== null) {
            $result['hash_id'] = $this->hashId;
        }
        if ($this->gatewayId !== null) {
            $result['gateway_id'] = $this->gatewayId;
        }
        if ($this->referenceId !== null) {
            $result['reference_id'] = $this->referenceId;
        }
        if ($this->amount !== null) {
            $result['amount'] = $this->amount;
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->callbackUrl !== null) {
            $result['callback_url'] = $this->callbackUrl;
        }
        if ($this->userId !== null) {
            $result['user_id'] = $this->userId;
        }
        if ($this->mobile !== null) {
            $result['mobile'] = $this->mobile;
        }
        if ($this->methodsData !== null) {
            $result['methods_data'] = array_map(fn($item) => $item->toArray(), $this->methodsData);
        }
        if ($this->status !== null) {
            $result['status'] = $this->status->toArray();
        }
        if ($this->payUrl !== null) {
            $result['pay_url'] = $this->payUrl;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
        }
        if ($this->updatedAt !== null) {
            $result['updated_at'] = $this->updatedAt->format('Y-m-d H:i:s');
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getHashId(): ?string
    {
        return $this->hashId;
    }

    public function getGatewayId(): ?int
    {
        return $this->gatewayId;
    }

    public function getReferenceId(): ?string
    {
        return $this->referenceId;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function getMethodsData(): ?array
    {
        return $this->methodsData;
    }

    public function getStatus(): ?TransactionStatusResource
    {
        return $this->status;
    }

    public function getPayUrl(): ?string
    {
        return $this->payUrl;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}
