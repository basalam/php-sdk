<?php

namespace Basalam\Upload\Models;

/**
 * File response model
 * Matching OpenAPI FileResponse schema
 */
class FileResponse implements \JsonSerializable
{
    // Required fields according to OpenAPI
    private int $id;
    private string $fileName;
    private string $fileNameAlone;
    private string $path;
    private string $format;
    private string $type;
    private int $fileType;
    private int $width;
    private int $height;
    private int $size;
    private int $duration;
    private array $urls;
    private string $createdAt;
    private int $creatorUserId;

    // Optional fields
    private ?string $mimeType;
    private ?string $url;

    public function __construct(
        int     $id,
        string  $fileName,
        string  $fileNameAlone,
        string  $path,
        string  $format,
        string  $type,
        int     $fileType,
        int     $width,
        int     $height,
        int     $size,
        int     $duration,
        array   $urls,
        string  $createdAt,
        int     $creatorUserId,
        ?string $mimeType = null,
        ?string $url = null
    )
    {
        $this->id = $id;
        $this->fileName = $fileName;
        $this->fileNameAlone = $fileNameAlone;
        $this->path = $path;
        $this->format = $format;
        $this->type = $type;
        $this->fileType = $fileType;
        $this->width = $width;
        $this->height = $height;
        $this->size = $size;
        $this->duration = $duration;
        $this->urls = $urls;
        $this->createdAt = $createdAt;
        $this->creatorUserId = $creatorUserId;
        $this->mimeType = $mimeType;
        $this->url = $url;
    }

    /**
     * Create from API response array
     * Note: API returns snake_case keys
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['file_name'],
            $data['file_name_alone'],
            $data['path'],
            $data['format'],
            $data['type'],
            $data['file_type'],
            $data['width'],
            $data['height'],
            $data['size'],
            $data['duration'],
            $data['urls'],
            $data['created_at'],
            $data['creator_user_id'],
            $data['mime_type'] ?? null,
            $data['url'] ?? null
        );
    }

    /**
     * Convert to array
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'file_name' => $this->fileName,
            'file_name_alone' => $this->fileNameAlone,
            'path' => $this->path,
            'format' => $this->format,
            'type' => $this->type,
            'file_type' => $this->fileType,
            'width' => $this->width,
            'height' => $this->height,
            'size' => $this->size,
            'duration' => $this->duration,
            'urls' => $this->urls,
            'created_at' => $this->createdAt,
            'creator_user_id' => $this->creatorUserId,
        ];

        if ($this->mimeType !== null) {
            $result['mime_type'] = $this->mimeType;
        }

        if ($this->url !== null) {
            $result['url'] = $this->url;
        }

        return $result;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getFileNameAlone(): string
    {
        return $this->fileNameAlone;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getFileType(): int
    {
        return $this->fileType;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getUrls(): array
    {
        return $this->urls;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getCreatorUserId(): int
    {
        return $this->creatorUserId;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Helper method to get a specific URL size
     *
     * @param string $size e.g., 'original', 'thumbnail', 'medium', etc.
     * @return string|null
     */
    public function getUrlBySize(string $size): ?string
    {
        return $this->urls[$size] ?? null;
    }

    /**
     * Check if this is an image file
     *
     * @return bool
     */
    public function isImage(): bool
    {
        return in_array($this->format, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp']);
    }

    /**
     * Check if this is a video file
     *
     * @return bool
     */
    public function isVideo(): bool
    {
        return in_array($this->format, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm']);
    }

    /**
     * Get file size in human-readable format
     *
     * @return string
     */
    public function getHumanReadableSize(): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = $this->size;

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}