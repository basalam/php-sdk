<?php

namespace Basalam\Upload;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Upload\Models\FileResponse;
use Basalam\Upload\Models\UploadFileRequest;
use InvalidArgumentException;
use RuntimeException;
use SplFileInfo;

/**
 * Client for the Upload service API.
 */
class UploadService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'upload');
    }

    /**
     * Upload a file.
     *
     * @param resource|string $file The file to upload (file path or file resource)
     * @param string $fileType The type of file being uploaded (must be one of UserUploadFileTypeEnum constants)
     * @param string|null $customUniqueName Optional custom unique name for the file
     * @param int|null $expireMinutes Optional expiration time in minutes
     * @return FileResponse The response containing the uploaded file details
     * @throws InvalidArgumentException If file type is invalid
     * @throws RuntimeException If file cannot be read
     */
    public function uploadFile(
        $file,
        string $fileType,
        ?string $customUniqueName = null,
        ?int $expireMinutes = null
    ): FileResponse
    {
        $endpoint = '/v1/files';

        // Validate that fileType is a valid enum value
        if (!Models\UserUploadFileTypeEnum::isValid($fileType)) {
            throw new InvalidArgumentException(
                "Invalid file type: '$fileType'. Must be one of UserUploadFileTypeEnum constants."
            );
        }

        // Create request model to validate parameters
        $request = new UploadFileRequest(
            fileType: $fileType,
            customUniqueName: $customUniqueName,
            expireMinutes: $expireMinutes
        );

        // Convert to form data, excluding null values
        $data = $request->toArray();

        // Prepare file for upload
        $files = $this->prepareFile($file);

        // Make the request
        $response = $this->post(
            path: $endpoint,
            data: $data,
            files: $files
        );

        return FileResponse::fromArray($response);
    }

    /**
     * Prepare file for upload.
     *
     * @param resource|string $file File path or file resource
     * @return array Files array for the post method
     * @throws RuntimeException If file cannot be read
     */
    private function prepareFile($file): array
    {
        // If it's a file path
        if (is_string($file)) {
            if (!file_exists($file)) {
                throw new RuntimeException("File not found: $file");
            }

            if (!is_readable($file)) {
                throw new RuntimeException("File is not readable: $file");
            }

            return [
                'file' => [
                    'path' => $file,
                    'filename' => basename($file),
                    'contents' => fopen($file, 'r'),
                ]
            ];
        }

        // If it's already a resource
        if (is_resource($file)) {
            // Try to get the filename from stream metadata
            $meta = stream_get_meta_data($file);
            $filename = basename($meta['uri'] ?? 'upload.bin');

            return [
                'file' => [
                    'contents' => $file,
                    'filename' => $filename,
                ]
            ];
        }

        // If it's a SplFileInfo object
        if ($file instanceof SplFileInfo) {
            $path = $file->getRealPath();

            if (!$file->isReadable()) {
                throw new RuntimeException("File is not readable: $path");
            }

            return [
                'file' => [
                    'path' => $path,
                    'filename' => $file->getFilename(),
                    'contents' => fopen($path, 'r'),
                ]
            ];
        }

        throw new InvalidArgumentException(
            'File must be a file path (string), resource, or SplFileInfo object'
        );
    }

}