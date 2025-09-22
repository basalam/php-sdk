<?php

namespace Basalam\Order\Models;

/**
 * Create payment request model
 */
class CreatePaymentRequestModel implements \JsonSerializable
{
    private array $payDrivers; // Dict[str, PaymentDriver]
    private string $callback;
    private ?string $optionCode;
    private ?string $nationalId;

    public function __construct(
        array   $payDrivers,
        string  $callback,
        ?string $optionCode = null,
        ?string $nationalId = null
    )
    {
        $this->payDrivers = $payDrivers;
        $this->callback = $callback;
        $this->optionCode = $optionCode;
        $this->nationalId = $nationalId;
    }

    public static function fromArray(array $data): self
    {
        $payDrivers = [];
        if (isset($data['pay_drivers'])) {
            foreach ($data['pay_drivers'] as $key => $driverData) {
                $payDrivers[$key] = is_array($driverData)
                    ? PaymentDriver::fromArray($driverData)
                    : $driverData;
            }
        }

        return new self(
            $payDrivers,
            $data['callback'],
            $data['option_code'] ?? null,
            $data['national_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'pay_drivers' => [],
            'callback' => $this->callback
        ];

        // Convert PaymentDriver objects to arrays
        foreach ($this->payDrivers as $key => $driver) {
            if ($driver instanceof PaymentDriver) {
                $result['pay_drivers'][$key] = $driver->toArray();
            } else {
                $result['pay_drivers'][$key] = $driver;
            }
        }

        if ($this->optionCode !== null) {
            $result['option_code'] = $this->optionCode;
        }

        if ($this->nationalId !== null) {
            $result['national_id'] = $this->nationalId;
        }

        return $result;
    }

    // Getters

    public function getPayDrivers(): array
    {
        return $this->payDrivers;
    }

    public function getCallback(): string
    {
        return $this->callback;
    }

    public function getOptionCode(): ?string
    {
        return $this->optionCode;
    }

    public function getNationalId(): ?string
    {
        return $this->nationalId;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}