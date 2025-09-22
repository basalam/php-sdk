<?php

namespace Basalam\Chat\Models;

/**
 * Response model for a single chat
 */
class ChatResponse implements \JsonSerializable
{
    private int $id;
    private bool $markedAsUnread;
    private int $unseenMessageCount;
    private string $updatedAt;
    private ?string $deletedAt;
    private ?string $createdAt;
    private ?string $modifiedAt;
    private string $chatType;
    private ?int $lastSeenId;
    private ?MessageResource $lastMessage;
    private ?Contact $contact;
    private ?int $contactId;
    private bool $contactIsBlocked;
    private bool $showApprovals;
    private ?array $replyMarkup;
    private ?string $archiveState;
    private ?GroupMetadata $group;
    private ?ChannelMetadata $channel;

    public function __construct(
        int              $id,
        bool             $markedAsUnread,
        int              $unseenMessageCount,
        string           $updatedAt,
        string           $chatType,
        bool             $contactIsBlocked,
        bool             $showApprovals,
        ?string          $deletedAt = null,
        ?string          $createdAt = null,
        ?string          $modifiedAt = null,
        ?int             $lastSeenId = null,
        ?MessageResource $lastMessage = null,
        ?Contact         $contact = null,
        ?int             $contactId = null,
        ?array           $replyMarkup = null,
        ?string          $archiveState = null,
        ?GroupMetadata   $group = null,
        ?ChannelMetadata $channel = null
    )
    {
        $this->id = $id;
        $this->markedAsUnread = $markedAsUnread;
        $this->unseenMessageCount = $unseenMessageCount;
        $this->updatedAt = $updatedAt;
        $this->chatType = $chatType;
        $this->contactIsBlocked = $contactIsBlocked;
        $this->showApprovals = $showApprovals;
        $this->deletedAt = $deletedAt;
        $this->createdAt = $createdAt;
        $this->modifiedAt = $modifiedAt;
        $this->lastSeenId = $lastSeenId;
        $this->lastMessage = $lastMessage;
        $this->contact = $contact;
        $this->contactId = $contactId;
        $this->replyMarkup = $replyMarkup;
        $this->archiveState = $archiveState;
        $this->group = $group;
        $this->channel = $channel;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['marked_as_unread'],
            $data['unseen_message_count'],
            $data['updated_at'],
            $data['chat_type'],
            $data['contact_is_blocked'],
            $data['show_approvals'],
            $data['deleted_at'] ?? null,
            $data['created_at'] ?? null,
            $data['modified_at'] ?? null,
            $data['last_seen_id'] ?? null,
            isset($data['last_message']) ? MessageResource::fromArray($data['last_message']) : null,
            isset($data['contact']) ? Contact::fromArray($data['contact']) : null,
            $data['contact_id'] ?? null,
            $data['reply_markup'] ?? null,
            $data['archive_state'] ?? null,
            isset($data['group']) ? GroupMetadata::fromArray($data['group']) : null,
            isset($data['channel']) ? ChannelMetadata::fromArray($data['channel']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'marked_as_unread' => $this->markedAsUnread,
            'unseen_message_count' => $this->unseenMessageCount,
            'updated_at' => $this->updatedAt,
            'chat_type' => $this->chatType,
            'contact_is_blocked' => $this->contactIsBlocked,
            'show_approvals' => $this->showApprovals
        ];

        if ($this->deletedAt !== null) {
            $result['deleted_at'] = $this->deletedAt;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt;
        }
        if ($this->modifiedAt !== null) {
            $result['modified_at'] = $this->modifiedAt;
        }
        if ($this->lastSeenId !== null) {
            $result['last_seen_id'] = $this->lastSeenId;
        }
        if ($this->lastMessage !== null) {
            $result['last_message'] = $this->lastMessage->toArray();
        }
        if ($this->contact !== null) {
            $result['contact'] = $this->contact->toArray();
        }
        if ($this->contactId !== null) {
            $result['contact_id'] = $this->contactId;
        }
        if ($this->replyMarkup !== null) {
            $result['reply_markup'] = $this->replyMarkup;
        }
        if ($this->archiveState !== null) {
            $result['archive_state'] = $this->archiveState;
        }
        if ($this->group !== null) {
            $result['group'] = $this->group->toArray();
        }
        if ($this->channel !== null) {
            $result['channel'] = $this->channel->toArray();
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function isMarkedAsUnread(): bool
    {
        return $this->markedAsUnread;
    }

    public function getUnseenMessageCount(): int
    {
        return $this->unseenMessageCount;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getModifiedAt(): ?string
    {
        return $this->modifiedAt;
    }

    public function getChatType(): string
    {
        return $this->chatType;
    }

    public function getLastSeenId(): ?int
    {
        return $this->lastSeenId;
    }

    public function getLastMessage(): ?MessageResource
    {
        return $this->lastMessage;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function getContactId(): ?int
    {
        return $this->contactId;
    }

    public function isContactBlocked(): bool
    {
        return $this->contactIsBlocked;
    }

    public function showApprovals(): bool
    {
        return $this->showApprovals;
    }

    public function getReplyMarkup(): ?array
    {
        return $this->replyMarkup;
    }

    public function getArchiveState(): ?string
    {
        return $this->archiveState;
    }

    public function getGroup(): ?GroupMetadata
    {
        return $this->group;
    }

    public function getChannel(): ?ChannelMetadata
    {
        return $this->channel;
    }
}