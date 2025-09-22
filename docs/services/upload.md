# Upload Service

This service provides secure file upload capabilities: securely upload files, support for various file types (images,
documents, videos), assign custom file names and expiration times, and receive file URLs for access.

## Table of Contents

- [Upload Methods](#upload-methods)
- [Examples](#examples)

## Upload Methods

| Method                         | Description   | Parameters                                              |
|--------------------------------|---------------|---------------------------------------------------------|
| [`uploadFile()`](#upload-file) | Upload a file | `file`, `fileType`, `customUniqueName`, `expireMinutes` |

### Parameters

- `file` - File path or file resource
- `fileType` - Type of file (from `UserUploadFileTypeEnum`). Supported file types:
    - Product: `product.photo`, `product.video`
    - User: `user.avatar`, `user.cover`
    - Vendor: `vendor.logo`, `vendor.cover`
    - Chat: `chat.photo`, `chat.video`, `chat.voice`, `chat.file`
- `customUniqueName` – Optional custom name for the file
- `expireMinutes` – Optional expiration time in minutes

## Examples

### Initial Configuration

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Upload File

```php
use Basalam\Upload\Models\UserUploadFileTypeEnum;

function uploadFileExample()
{
    global $client;
    
    $response = $client->uploadFile(
        file: "image.png",
        fileType: UserUploadFileTypeEnum::PRODUCT_PHOTO
    );
    return $response;
}
```

#### Sample Response

The upload response is handled by the `FileResponse` model:

```php
FileResponse(
  id: 238300331,
  fileName: 'image.png',
  fileNameAlone: 'image',
  path: 'users/b28/07-13',
  format: 'png',
  type: 'image',
  fileType: 5901,
  width: 228,
  height: 154,
  size: 58007,
  duration: 0,
  urls: ['primary' => '...'],
  createdAt: '2025-07-13 14:07:47',
  creatorUserId: 430,
  mimeType: null,
  url: null
)
```

To see the list of valid upload formats, refer to [this document](http://localhost:8080/services/upload#فرمتهای-مجاز).