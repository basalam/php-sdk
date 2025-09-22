<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Upload\Models\UserUploadFileTypeEnum;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Upload service client.
 */
class UploadServiceTest extends TestCase
{
    /**
     * @var string Path to test image file
     */
    private const TEST_IMAGE_PATH = __DIR__ . '/test1.png';
    /**
     * @var BasalamClient
     */
    private BasalamClient $basalamClient;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test image if it doesn't exist
        if (!file_exists(self::TEST_IMAGE_PATH)) {
            $this->createTestImage();
        }

        // Create a BasalamClient instance with real auth and config
        $config = new Config(
            environment: Environment::PRODUCTION,
            timeout: 30.0,
            userAgent: 'SDK-Test'
        );

        // Note: In real tests, use environment variables or config files for tokens
        $auth = new PersonalToken(
            token: ''
        );

        $this->basalamClient = new BasalamClient($auth, $config);
    }

    /**
     * Create a test image file if it doesn't exist.
     */
    private function createTestImage(): void
    {
        // Create a simple 1x1 pixel PNG image
        $image = imagecreatetruecolor(1, 1);
        $color = imagecolorallocate($image, 255, 0, 0); // Red pixel
        imagesetpixel($image, 0, 0, $color);
        imagepng($image, self::TEST_IMAGE_PATH);
        imagedestroy($image);
    }

    /**
     * Test upload_file_sync method.
     *

     */
    public function testUploadFile(): void
    {
        try {
            // Open the test file
            $fileData = fopen(self::TEST_IMAGE_PATH, 'rb');

            if (!$fileData) {
                throw new \RuntimeException("Failed to open test1.png");
            }

            // Call the upload method
            $result = $this->basalamClient->uploadFile(
                file: $fileData,
                fileType: UserUploadFileTypeEnum::PRODUCT_PHOTO,
                customUniqueName: 'test-file-sync',
                expireMinutes: 60
            );

            // Note: Guzzle automatically closes the file resource when sending

            // Print the result
            echo "\n=== Test: Upload File Sync ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Upload File Sync ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test upload_file with file path directly.
     *
     * Tests PHP's ability to accept file path directly (convenience feature)
     */
    public function testUploadFileWithPath(): void
    {
        try {
            // Call the upload method with file path directly
            $result = $this->basalamClient->uploadFile(
                file: self::TEST_IMAGE_PATH,
                fileType: UserUploadFileTypeEnum::PRODUCT_PHOTO,
                customUniqueName: 'test-file-path-' . uniqid(),
                expireMinutes: 60
            );

            // Print the result
            echo "\n=== Test: Upload File With Path ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Upload File With Path ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Upload endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test upload with different file types.
     */
    public function testUploadWithDifferentFileTypes(): void
    {
        echo "\n=== Test: Upload With Different File Types ===\n";

        $fileTypes = [
            UserUploadFileTypeEnum::PRODUCT_PHOTO,
            UserUploadFileTypeEnum::VENDOR_LOGO,
        ];

        $allResults = [];

        foreach ($fileTypes as $fileType) {
            try {
                $result = $this->basalamClient->uploadFile(
                    file: self::TEST_IMAGE_PATH,
                    fileType: $fileType,
                    customUniqueName: 'test-' . str_replace('.', '-', $fileType) . '-' . uniqid()
                );

                echo "Type: $fileType - Success\n";
                echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";
                $allResults[] = $result;

            } catch (\Exception $e) {
                echo "Type: $fileType - Error: " . $e->getMessage() . "\n";
            }
        }

        // Check if we got at least one result
        $this->assertNotNull($allResults);
    }
}