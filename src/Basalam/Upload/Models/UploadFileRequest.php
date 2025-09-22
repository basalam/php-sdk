<?php

namespace Basalam\Upload\Models;

/**
 * Upload file request model
 * Matching OpenAPI Body_create_file_v3_files_post schema
 */
class UploadFileRequest
{
    private string $fileType;
    private ?string $customUniqueName;
    private ?int $expireMinutes;

    public function __construct(
        string  $fileType,
        ?string $customUniqueName = null,
        ?int    $expireMinutes = null
    )
    {
        // Validate file type
        if (!UserUploadFileTypeEnum::isValid($fileType)) {
            throw new \InvalidArgumentException(
                "Invalid file type: {$fileType}. Must be one of: " .
                implode(', ', UserUploadFileTypeEnum::getAllTypes())
            );
        }

        $this->fileType = $fileType;
        $this->customUniqueName = $customUniqueName;
        $this->expireMinutes = $expireMinutes;
    }

    /**
     * Create from array
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['file_type'],
            $data['custom_unique_name'] ?? null,
            $data['expire_minutes'] ?? null
        );
    }

    /**
     * Convert to array for form data (not JSON)
     * Note: Uses snake_case for consistency with API
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'file_type' => $this->fileType,
        ];

        if ($this->customUniqueName !== null) {
            $data['custom_unique_name'] = $this->customUniqueName;
        }

        if ($this->expireMinutes !== null) {
            $data['expire_minutes'] = $this->expireMinutes;
        }

        return $data;
    }

    // Getters

    public function getFileType(): string
    {
        return $this->fileType;
    }

    public function setFileType(string $fileType): self
    {
        if (!UserUploadFileTypeEnum::isValid($fileType)) {
            throw new \InvalidArgumentException("Invalid file type: {$fileType}");
        }
        $this->fileType = $fileType;
        return $this;
    }

    public function getCustomUniqueName(): ?string
    {
        return $this->customUniqueName;
    }

    // Setters

    public function setCustomUniqueName(?string $customUniqueName): self
    {
        $this->customUniqueName = $customUniqueName;
        return $this;
    }

    public function getExpireMinutes(): ?int
    {
        return $this->expireMinutes;
    }

    public function setExpireMinutes(?int $expireMinutes): self
    {
        $this->expireMinutes = $expireMinutes;
        return $this;
    }
}