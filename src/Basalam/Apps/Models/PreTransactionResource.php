<?php

namespace Basalam\Apps\Models;

/**
 * PreTransactionResource model.
 */
class PreTransactionResource implements \JsonSerializable
{
    private ?string $hashId;
    private ?string $payUrl;
    private ?PreTransactionOrderResource $order;
    private ?string $expiredAt;
    private ?PreTransactionGatewayResource $gateway;
    private ?PreTransactionAppResource $app;
    private ?array $payMethods;
    private ?PreTransactionPlanResource $plan;

    public function __construct(
        ?string $hashId,
        ?string $payUrl,
        ?PreTransactionOrderResource $order,
        ?string $expiredAt,
        ?PreTransactionGatewayResource $gateway,
        ?PreTransactionAppResource $app,
        ?array $payMethods,
        ?PreTransactionPlanResource $plan
    ) {
        $this->hashId = $hashId;
        $this->payUrl = $payUrl;
        $this->order = $order;
        $this->expiredAt = $expiredAt;
        $this->gateway = $gateway;
        $this->app = $app;
        $this->payMethods = $payMethods;
        $this->plan = $plan;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['hash_id'] ?? null,
            $data['pay_url'] ?? null,
            isset($data['order']) ? PreTransactionOrderResource::fromArray($data['order']) : null,
            $data['expired_at'] ?? null,
            isset($data['gateway']) ? PreTransactionGatewayResource::fromArray($data['gateway']) : null,
            isset($data['app']) ? PreTransactionAppResource::fromArray($data['app']) : null,
            isset($data['pay_methods']) ? array_map(fn($item) => PreTransactionPayMethodResource::fromArray($item), $data['pay_methods']) : null,
            isset($data['plan']) ? PreTransactionPlanResource::fromArray($data['plan']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->hashId !== null) {
            $result['hash_id'] = $this->hashId;
        }
        if ($this->payUrl !== null) {
            $result['pay_url'] = $this->payUrl;
        }
        if ($this->order !== null) {
            $result['order'] = $this->order->toArray();
        }
        if ($this->expiredAt !== null) {
            $result['expired_at'] = $this->expiredAt;
        }
        if ($this->gateway !== null) {
            $result['gateway'] = $this->gateway->toArray();
        }
        if ($this->app !== null) {
            $result['app'] = $this->app->toArray();
        }
        if ($this->payMethods !== null) {
            $result['pay_methods'] = array_map(fn($item) => $item->toArray(), $this->payMethods);
        }
        if ($this->plan !== null) {
            $result['plan'] = $this->plan->toArray();
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

    public function getPayUrl(): ?string
    {
        return $this->payUrl;
    }

    public function getOrder(): ?PreTransactionOrderResource
    {
        return $this->order;
    }

    public function getExpiredAt(): ?string
    {
        return $this->expiredAt;
    }

    public function getGateway(): ?PreTransactionGatewayResource
    {
        return $this->gateway;
    }

    public function getApp(): ?PreTransactionAppResource
    {
        return $this->app;
    }

    public function getPayMethods(): ?array
    {
        return $this->payMethods;
    }

    public function getPlan(): ?PreTransactionPlanResource
    {
        return $this->plan;
    }
}
