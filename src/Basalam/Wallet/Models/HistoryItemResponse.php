<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * History item response model.
 */
class HistoryItemResponse implements \JsonSerializable
{
    private DateTime $time;
    private int $amount;
    private int $subtotal;
    private string $description;
    private int $mainReferenceId;
    private ?ReasonResponse $reason;
    private array $references;
    private ?NewHistoryCreditResponse $relatedCredit;
    private ?HistorySpendResponse $relatedSpend;

    public function __construct(
        DateTime                  $time,
        int                       $amount,
        int                       $subtotal,
        string                    $description,
        int                       $mainReferenceId,
        ?ReasonResponse           $reason,
        array                     $references,
        ?NewHistoryCreditResponse $relatedCredit = null,
        ?HistorySpendResponse     $relatedSpend = null
    )
    {
        $this->time = $time;
        $this->amount = $amount;
        $this->subtotal = $subtotal;
        $this->description = $description;
        $this->mainReferenceId = $mainReferenceId;
        $this->reason = $reason;
        $this->references = $references;
        $this->relatedCredit = $relatedCredit;
        $this->relatedSpend = $relatedSpend;
    }

    public static function fromArray(array $data): self
    {
        $references = array_map(fn($ref) => ReferenceResponse::fromArray($ref), $data['references']);

        return new self(
            new DateTime($data['time']),
            $data['amount'],
            $data['subtotal'],
            $data['description'],
            $data['main_reference_id'],
            isset($data['reason']) ? ReasonResponse::fromArray($data['reason']) : null,
            $references,
            isset($data['related_credit']) ? NewHistoryCreditResponse::fromArray($data['related_credit']) : null,
            isset($data['related_spend']) ? HistorySpendResponse::fromArray($data['related_spend']) : null
        );
    }

    // Getters
    public function getTime(): DateTime
    {
        return $this->time;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getSubtotal(): int
    {
        return $this->subtotal;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMainReferenceId(): int
    {
        return $this->mainReferenceId;
    }

    public function getReason(): ?ReasonResponse
    {
        return $this->reason;
    }

    public function getReferences(): array
    {
        return $this->references;
    }

    public function getRelatedCredit(): ?NewHistoryCreditResponse
    {
        return $this->relatedCredit;
    }

    public function getRelatedSpend(): ?HistorySpendResponse
    {
        return $this->relatedSpend;
    }

    public function toArray(): array
    {
        $result = [
            'time' => $this->time->format('Y-m-d H:i:s'),
            'amount' => $this->amount,
            'subtotal' => $this->subtotal,
            'description' => $this->description,
            'main_reference_id' => $this->mainReferenceId,
            'references' => array_map(fn($ref) => $ref->toArray(), $this->references),
        ];

        if ($this->reason !== null) {
            $result['reason'] = $this->reason->toArray();
        }
        if ($this->relatedCredit !== null) {
            $result['related_credit'] = $this->relatedCredit->toArray();
        }
        if ($this->relatedSpend !== null) {
            $result['related_spend'] = $this->relatedSpend->toArray();
        }

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}