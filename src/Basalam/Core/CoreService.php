<?php

namespace Basalam\Core;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Core\Models\AttributesResponse;
use Basalam\Core\Models\BatchUpdateProductsRequest;
use Basalam\Core\Models\BulkProductsUpdateRequestSchema;
use Basalam\Core\Models\BulkProductsUpdateResponseSchema;
use Basalam\Core\Models\BulkProductsUpdatesCountResponse;
use Basalam\Core\Models\BulkProductsUpdatesListResponse;
use Basalam\Core\Models\CategoriesResponse;
use Basalam\Core\Models\CategoryResponse;
use Basalam\Core\Models\ChangeUserMobileConfirmSchema;
use Basalam\Core\Models\ChangeUserMobileRequestSchema;
use Basalam\Core\Models\ChangeVendorMobileConfirmSchema;
use Basalam\Core\Models\ChangeVendorMobileRequestSchema;
use Basalam\Core\Models\ConfirmCurrentUserMobileConfirmSchema;
use Basalam\Core\Models\CreateDiscountRequestSchema;
use Basalam\Core\Models\CreateVendorSchema;
use Basalam\Core\Models\DeleteDiscountRequestSchema;
use Basalam\Core\Models\GetProductsQuerySchema;
use Basalam\Core\Models\GetVendorProductsSchema;
use Basalam\Core\Models\PrivateUserResponse;
use Basalam\Core\Models\PrivateVendorResponse;
use Basalam\Core\Models\ProductListResponse;
use Basalam\Core\Models\ProductRequestSchema;
use Basalam\Core\Models\ProductResponseSchema;
use Basalam\Core\Models\ProductShelfResponse;
use Basalam\Core\Models\PublicVendorResponse;
use Basalam\Core\Models\ResultResponse;
use Basalam\Core\Models\ShippingMethodListResponse;
use Basalam\Core\Models\ShippingMethodResponse;
use Basalam\Core\Models\UnsuccessfulBulkUpdateProducts;
use Basalam\Core\Models\UpdateProductResponseItem;
use Basalam\Core\Models\UpdateProductVariationSchema;
use Basalam\Core\Models\UpdateShippingMethodSchema;
use Basalam\Core\Models\UpdateUserBankInformationSchema;
use Basalam\Core\Models\UpdateVendorSchema;
use Basalam\Core\Models\UpdateVendorStatusResponse;
use Basalam\Core\Models\UpdateVendorStatusSchema;
use Basalam\Core\Models\UserCardsOtpSchema;
use Basalam\Core\Models\UserCardsSchema;
use Basalam\Core\Models\UserVerificationSchema;
use Basalam\Core\Models\UserVerifyBankInformationSchema;
use Basalam\Http\BaseClient;

class CoreService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'core');
    }

    /**
     * Create a new vendor
     *
     * @param int $userId
     * @param CreateVendorSchema $request
     * @return PublicVendorResponse
     */
    public function createVendor(int $userId, CreateVendorSchema $request): PublicVendorResponse
    {
        $endpoint = "/v3/users/$userId/vendors";
        $response = $this->post($endpoint, $request->toArray());
        return PublicVendorResponse::fromArray($response);
    }

    /**
     * Update vendor
     *
     * @param int $vendorId
     * @param UpdateVendorSchema $request
     * @return PublicVendorResponse
     */
    public function updateVendor(int $vendorId, UpdateVendorSchema $request): PublicVendorResponse
    {
        $endpoint = "/v3/vendors/$vendorId";
        $response = $this->patch($endpoint, $request->toArray());
        return PublicVendorResponse::fromArray($response);
    }

    /**
     * Get vendor details
     *
     * @param int $vendorId
     * @param string|null $prefer
     * @return PublicVendorResponse|PrivateVendorResponse
     */
    public function getVendor(int $vendorId, ?string $prefer = "return=minimal"): PublicVendorResponse|PrivateVendorResponse
    {
        $endpoint = "/v3/vendors/$vendorId";
        $headers = [];
        if ($prefer) {
            $headers['Prefer'] = $prefer;
        }
        $response = $this->get($endpoint, [], $headers);

        // Determine which response type based on data
        if ($prefer === 'return=full') {
            return PrivateVendorResponse::fromArray($response);
        }
        return PublicVendorResponse::fromArray($response);
    }

    /**
     * Get default shipping methods
     *
     * @return array Array of ShippingMethodResponse
     */
    public function getDefaultShippingMethods(): array
    {
        $endpoint = "/v3/shipping-methods/defaults";
        $response = $this->get($endpoint);
        return array_map(fn($item) => ShippingMethodResponse::fromArray($item), $response);
    }

    /**
     * Get shipping methods
     *
     * @param array|null $ids
     * @param array|null $vendorIds
     * @param int $page
     * @param int $perPage
     * @param string|null $prefer
     * @return ShippingMethodListResponse
     */
    public function getShippingMethods(
        ?array  $ids = null,
        ?array  $vendorIds = null,
        int     $page = 1,
        int     $perPage = 10,
        ?string $prefer = null
    ): ShippingMethodListResponse
    {
        $endpoint = "/v3/shipping-methods";
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];

        if ($ids !== null) {
            $params['ids'] = $ids;
        }
        if ($vendorIds !== null) {
            $params['vendor_ids'] = $vendorIds;
        }

        $headers = [];
        if ($prefer !== null) {
            $headers['Prefer'] = $prefer;
        }

        $response = $this->get($endpoint, $params, $headers);
        return ShippingMethodListResponse::fromArray($response);
    }

    /**
     * Get working shipping methods
     *
     * @param int $vendorId
     * @return array Array of ShippingMethodResponse
     */
    public function getWorkingShippingMethods(int $vendorId): array
    {
        $endpoint = "/v3/vendors/$vendorId/shipping-methods";
        $response = $this->get($endpoint);
        return array_map(fn($item) => ShippingMethodResponse::fromArray($item), $response);
    }

    /**
     * Update shipping methods
     *
     * @param int $vendorId
     * @param UpdateShippingMethodSchema $request
     * @return array Array of ShippingMethodResponse
     */
    public function updateShippingMethods(int $vendorId, UpdateShippingMethodSchema $request): array
    {
        $endpoint = "/v3/vendors/$vendorId/shipping-methods";
        $response = $this->put($endpoint, $request->toArray());
        return array_map(fn($item) => ShippingMethodResponse::fromArray($item), $response);
    }

    /**
     * Get vendor products
     *
     * @param int $vendorId
     * @param GetVendorProductsSchema|null $queryParams
     * @return ProductListResponse
     */
    public function getVendorProducts(int $vendorId, ?GetVendorProductsSchema $queryParams = null): ProductListResponse
    {
        $endpoint = "/v3/vendors/$vendorId/products";
        $params = $queryParams ? $queryParams->toArray() : [];
        $response = $this->get($endpoint, $params);
        return ProductListResponse::fromArray($response);
    }

    /**
     * Update vendor status
     *
     * @param int $vendorId
     * @param UpdateVendorStatusSchema $request
     * @return UpdateVendorStatusResponse
     */
    public function updateVendorStatus(int $vendorId, UpdateVendorStatusSchema $request): UpdateVendorStatusResponse
    {
        $endpoint = "/v3/vendors/$vendorId/status";
        $response = $this->patch($endpoint, $request->toArray());
        return UpdateVendorStatusResponse::fromArray($response);
    }

    /**
     * Create vendor mobile change request
     *
     * @param int $vendorId
     * @param ChangeVendorMobileRequestSchema $request
     * @return ResultResponse
     */
    public function createVendorMobileChangeRequest(int $vendorId, ChangeVendorMobileRequestSchema $request): ResultResponse
    {
        $endpoint = "/v3/vendors/$vendorId/change-mobile-request";
        $response = $this->post($endpoint, $request->toArray());
        return ResultResponse::fromArray($response);
    }

    /**
     * Create vendor mobile change confirmation
     *
     * @param int $vendorId
     * @param ChangeVendorMobileConfirmSchema $request
     * @return ResultResponse
     */
    public function createVendorMobileChangeConfirmation(int $vendorId, ChangeVendorMobileConfirmSchema $request): ResultResponse
    {
        $endpoint = "/v3/vendors/$vendorId/change-mobile-confirm";
        $response = $this->post($endpoint, $request->toArray());
        return ResultResponse::fromArray($response);
    }

    /**
     * Create product with optional automatic file upload
     *
     * This method can automatically upload photo and video files, then creates the product
     * with the uploaded file IDs merged with any existing IDs in the request.
     *
     * @param int $vendorId The ID of the vendor
     * @param ProductRequestSchema $request The product creation request
     * @param array $photoFiles Optional array of photo file resources or paths to upload
     * @param resource|string|null $videoFile Optional video file resource or path to upload
     * @return ProductResponseSchema The created product resource
     * @throws \Basalam\Exceptions\BasalamException
     */
    public function createProduct(
        int                  $vendorId,
        ProductRequestSchema $request,
        array                $photoFiles = [],
                             $videoFile = null
    ): ProductResponseSchema
    {
        // Create a copy of the request to avoid modifying the original
        $enhancedRequest = clone $request;
        $enhancedData = $enhancedRequest->toArray();

        // If files are provided, upload them first
        if (!empty($photoFiles) || $videoFile !== null) {
            // Create upload service instance
            $uploadService = new \Basalam\Upload\UploadService($this->auth, $this->config);

            // Initialize existing IDs
            $existingPhotoIds = $enhancedData['photos'] ?? [];
            if (isset($enhancedData['photo'])) {
                array_unshift($existingPhotoIds, $enhancedData['photo']);
            }

            $existingVideoId = $enhancedData['video'] ?? null;

            // Upload photo files if provided
            $uploadedPhotoIds = [];
            foreach ($photoFiles as $photoFile) {
                $response = $uploadService->uploadFile(
                    file: $photoFile,
                    fileType: \Basalam\Upload\Models\UserUploadFileTypeEnum::PRODUCT_PHOTO,
                    customUniqueName: null,
                    expireMinutes: null
                );
                $uploadedPhotoIds[] = $response->getId();
            }

            // Upload video file if provided
            $uploadedVideoId = null;
            if ($videoFile !== null) {
                $response = $uploadService->uploadFile(
                    file: $videoFile,
                    fileType: \Basalam\Upload\Models\UserUploadFileTypeEnum::PRODUCT_VIDEO,
                    customUniqueName: null,
                    expireMinutes: null
                );
                $uploadedVideoId = $response->getId();
            }

            // Merge photo IDs
            $allPhotoIds = array_merge($existingPhotoIds, $uploadedPhotoIds);

            // Set photo/photos fields based on total count
            // The photo field is always required when there are photos
            // First photo goes to photo field, remaining photos go to photos field
            if (count($allPhotoIds) == 0) {
                $enhancedData['photo'] = null;
                $enhancedData['photos'] = null;
            } elseif (count($allPhotoIds) == 1) {
                $enhancedData['photo'] = $allPhotoIds[0];
                $enhancedData['photos'] = null;
            } else {
                $enhancedData['photo'] = $allPhotoIds[0];  // First photo in photo field
                $enhancedData['photos'] = array_slice($allPhotoIds, 1);  // Remaining photos in photos field
            }

            // Set video field
            if ($uploadedVideoId !== null) {
                $enhancedData['video'] = $uploadedVideoId;
            } elseif ($existingVideoId !== null) {
                $enhancedData['video'] = $existingVideoId;
            }
        } else {
            $enhancedData = $request->toArray();
        }

        // Create the product with enhanced request
        $endpoint = "/v4/vendors/$vendorId/products";
        $response = $this->post($endpoint, $enhancedData);
        return ProductResponseSchema::fromArray($response);
    }

    /**
     * Update product with optional automatic file upload
     *
     * This method can automatically upload photo and video files, then updates the product
     * with the uploaded file IDs merged with any existing IDs in the request.
     *
     * @param int $productId The ID of the product to update
     * @param ProductRequestSchema $request The product update request
     * @param array $photoFiles Optional array of photo file resources or paths to upload
     * @param resource|string|null $videoFile Optional video file resource or path to upload
     * @return ProductResponseSchema The updated product resource
     * @throws \Basalam\Exceptions\BasalamException
     */
    public function updateProduct(
        int                  $productId,
        ProductRequestSchema $request,
        array                $photoFiles = [],
                             $videoFile = null
    ): ProductResponseSchema
    {
        // Create a copy of the request to avoid modifying the original
        $enhancedRequest = clone $request;
        $enhancedData = $enhancedRequest->toArray();

        // If files are provided, upload them first
        if (!empty($photoFiles) || $videoFile !== null) {
            // Create upload service instance
            $uploadService = new \Basalam\Upload\UploadService($this->auth, $this->config);

            // Initialize existing IDs
            $existingPhotoIds = $enhancedData['photos'] ?? [];
            if (isset($enhancedData['photo'])) {
                array_unshift($existingPhotoIds, $enhancedData['photo']);
            }

            $existingVideoId = $enhancedData['video'] ?? null;

            // Upload photo files if provided
            $uploadedPhotoIds = [];
            foreach ($photoFiles as $photoFile) {
                $response = $uploadService->uploadFile(
                    file: $photoFile,
                    fileType: \Basalam\Upload\Models\UserUploadFileTypeEnum::PRODUCT_PHOTO,
                    customUniqueName: null,
                    expireMinutes: null
                );
                $uploadedPhotoIds[] = $response->getId();
            }

            // Upload video file if provided
            $uploadedVideoId = null;
            if ($videoFile !== null) {
                $response = $uploadService->uploadFile(
                    file: $videoFile,
                    fileType: \Basalam\Upload\Models\UserUploadFileTypeEnum::PRODUCT_VIDEO,
                    customUniqueName: null,
                    expireMinutes: null
                );
                $uploadedVideoId = $response->getId();
            }

            // Merge photo IDs
            $allPhotoIds = array_merge($existingPhotoIds, $uploadedPhotoIds);

            // Set photo/photos fields based on total count
            // The photo field is always required when there are photos
            // First photo goes to photo field, remaining photos go to photos field
            if (count($allPhotoIds) == 0) {
                $enhancedData['photo'] = null;
                $enhancedData['photos'] = null;
            } elseif (count($allPhotoIds) == 1) {
                $enhancedData['photo'] = $allPhotoIds[0];
                $enhancedData['photos'] = null;
            } else {
                $enhancedData['photo'] = $allPhotoIds[0];  // First photo in photo field
                $enhancedData['photos'] = array_slice($allPhotoIds, 1);  // Remaining photos in photos field
            }

            // Set video field
            if ($uploadedVideoId !== null) {
                $enhancedData['video'] = $uploadedVideoId;
            } elseif ($existingVideoId !== null) {
                $enhancedData['video'] = $existingVideoId;
            }
        } else {
            $enhancedData = $request->toArray();
        }

        // Update the product with enhanced request
        $endpoint = "/v3/products/$productId";
        $response = $this->patch($endpoint, $enhancedData);
        return ProductResponseSchema::fromArray($response);
    }

    /**
     * Get product details
     *
     * @param int $productId
     * @param string|null $prefer
     * @return ProductResponseSchema
     */
    public function getProduct(int $productId, ?string $prefer = "return=minimal"): ProductResponseSchema
    {
        $endpoint = "/v3/products/$productId";
        $headers = [];
        if ($prefer) {
            $headers['Prefer'] = $prefer;
        }
        $response = $this->get($endpoint, [], $headers);
        return ProductResponseSchema::fromArray($response);
    }

    /**
     * Get products list
     *
     * @param GetProductsQuerySchema|null $queryParams
     * @param string|null $prefer
     * @return ProductListResponse
     */
    public function getProducts(?GetProductsQuerySchema $queryParams = null, ?string $prefer = "return=minimal"): ProductListResponse
    {
        $endpoint = "/v3/products";
        $params = $queryParams ? $queryParams->toArray() : [];
        $headers = [];
        if ($prefer) {
            $headers['Prefer'] = $prefer;
        }
        $response = $this->get($endpoint, $params, $headers);
        return ProductListResponse::fromArray($response);
    }

    /**
     * Update product variation
     *
     * @param int $productId
     * @param int $variationId
     * @param UpdateProductVariationSchema $request
     * @return ProductResponseSchema
     */
    public function updateProductVariation(int $productId, int $variationId, UpdateProductVariationSchema $request): ProductResponseSchema
    {
        $endpoint = "/v4/products/$productId/variations/$variationId";
        $data = $request->toArray();
        $response = $this->patch($endpoint, $data);
        return ProductResponseSchema::fromArray($response);
    }

    /**
     * Create products bulk action request
     *
     * @param int $vendorId
     * @param BulkProductsUpdateRequestSchema $request
     * @return BulkProductsUpdateResponseSchema
     */
    public function createProductsBulkActionRequest(int $vendorId, BulkProductsUpdateRequestSchema $request): BulkProductsUpdateResponseSchema
    {
        $endpoint = "/v4/vendors/$vendorId/bulk-update-product-request";
        $response = $this->post($endpoint, $request->toArray());
        return BulkProductsUpdateResponseSchema::fromArray($response);
    }

    /**
     * Get products bulk action requests
     *
     * @param int $vendorId
     * @param int $page
     * @param int $perPage
     * @return BulkProductsUpdatesListResponse
     */
    public function getProductsBulkActionRequests(
        int $vendorId,
        int $page = 1,
        int $perPage = 10
    ): BulkProductsUpdatesListResponse
    {
        $endpoint = "/v3/vendors/$vendorId/bulk-update-product-request";
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        $response = $this->get($endpoint, $params);
        return BulkProductsUpdatesListResponse::fromArray($response);
    }

    /**
     * Get products bulk action requests count
     *
     * @param int $vendorId
     * @return BulkProductsUpdatesCountResponse
     */
    public function getProductsBulkActionRequestsCount(int $vendorId): BulkProductsUpdatesCountResponse
    {
        $endpoint = "/v3/vendors/$vendorId/bulk-update-product-request/count";
        $response = $this->get($endpoint);
        return BulkProductsUpdatesCountResponse::fromArray($response);
    }

    /**
     * Get products unsuccessful bulk action requests
     *
     * @param int $requestId
     * @param int $page
     * @param int $perPage
     * @return UnsuccessfulBulkUpdateProducts
     */
    public function getProductsUnsuccessfulBulkActionRequests(
        int $requestId,
        int $page = 1,
        int $perPage = 10
    ): UnsuccessfulBulkUpdateProducts
    {
        $endpoint = "/v3/bulk-update-product-request/$requestId/unsuccessful_products";
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];

        $response = $this->get($endpoint, $params);
        return UnsuccessfulBulkUpdateProducts::fromArray($response);
    }

    /**
     * Get product shelves
     *
     * @param int $productId
     * @return array Array of ProductShelfResponse
     */
    public function getProductShelves(int $productId): array
    {
        $endpoint = "/v3/products/$productId/shelves";
        $response = $this->get($endpoint);
        return array_map(fn($item) => ProductShelfResponse::fromArray($item), $response);
    }

    /**
     * Update bulk products
     *
     * @param int $vendorId
     * @param array|BatchUpdateProductsRequest $request
     * @return array Array of UpdateProductResponseItem
     */
    public function updateBulkProducts(int $vendorId, BatchUpdateProductsRequest|array $request): array
    {
        $endpoint = "/v4/vendors/$vendorId/products";
        $data = is_array($request) ? $request : $request->toArray();
        $response = $this->patch($endpoint, $data);
        return array_map(fn($item) => UpdateProductResponseItem::fromArray($item), $response);
    }

    /**
     * Create discount for products
     *
     * @param int $vendorId
     * @param CreateDiscountRequestSchema $request
     * @return array
     */
    public function createDiscount(int $vendorId, CreateDiscountRequestSchema $request): array
    {
        $endpoint = "/v3/vendors/$vendorId/discounts";
        $data = $request->toArray();
        return $this->post($endpoint, $data);
    }

    /**
     * Delete discount for products
     *
     * @param int $vendorId
     * @param DeleteDiscountRequestSchema $request
     * @return array
     */
    public function deleteDiscount(int $vendorId, DeleteDiscountRequestSchema $request): array
    {
        $endpoint = "/v3/vendors/$vendorId/discounts";
        $data = $request->toArray();
        return $this->delete($endpoint, [], $data);
    }

    /**
     * Get current user info
     *
     * @return PrivateUserResponse
     */
    public function getCurrentUser(): PrivateUserResponse
    {
        $endpoint = "/v3/users/me";
        $response = $this->get($endpoint);
        return PrivateUserResponse::fromArray($response);
    }

    /**
     * Create user mobile confirmation request
     *
     * @param int $userId
     * @return ResultResponse
     */
    public function createUserMobileConfirmationRequest(int $userId): ResultResponse
    {
        $endpoint = "/v3/users/$userId/confirm-mobile-request";
        $response = $this->post($endpoint, []);
        return ResultResponse::fromArray($response);
    }

    /**
     * Verify user mobile confirmation request
     *
     * @param int $userId
     * @param ConfirmCurrentUserMobileConfirmSchema $request
     * @return ResultResponse
     */
    public function verifyUserMobileConfirmationRequest(int $userId, ConfirmCurrentUserMobileConfirmSchema $request): ResultResponse
    {
        $endpoint = "/v3/users/$userId/confirm-mobile";
        $data = $request->toArray();
        $response = $this->post($endpoint, $data);
        return ResultResponse::fromArray($response);
    }

    /**
     * Create user mobile change request
     *
     * @param int $userId
     * @param ChangeUserMobileRequestSchema $request
     * @return ResultResponse
     */
    public function createUserMobileChangeRequest(int $userId, ChangeUserMobileRequestSchema $request): ResultResponse
    {
        $endpoint = "/v3/users/$userId/change-mobile-request";
        $data = $request->toArray();
        $response = $this->post($endpoint, $data);
        return ResultResponse::fromArray($response);
    }

    /**
     * Verify user mobile change request
     *
     * @param int $userId
     * @param ChangeUserMobileConfirmSchema $request
     * @return ResultResponse
     */
    public function verifyUserMobileChangeRequest(int $userId, ChangeUserMobileConfirmSchema $request): ResultResponse
    {
        $endpoint = "/v3/users/$userId/change-mobile-confirm";
        $data = $request->toArray();
        $response = $this->post($endpoint, $data);
        return ResultResponse::fromArray($response);
    }

    /**
     * Create user bank account
     *
     * @param int $userId
     * @param UserCardsSchema $request
     * @param string|null $prefer
     * @return array
     */
    public function createUserBankAccount(int $userId, UserCardsSchema $request, ?string $prefer = "return=minimal"): array
    {
        $endpoint = "/v3/users/$userId/bank-information";
        $data = $request->toArray();
        $headers = [];
        if ($prefer) {
            $headers['Prefer'] = $prefer;
        }
        // Fix parameter order: post(path, data, files, headers)
        return $this->post($endpoint, $data, [], $headers);
    }

    /**
     * Get user bank accounts
     *
     * @param int $userId
     * @param string|null $prefer
     * @return array
     */
    public function getUserBankAccounts(int $userId, ?string $prefer = "return=minimal"): array
    {
        $endpoint = "/v3/users/$userId/bank-information";
        $headers = [];
        if ($prefer) {
            $headers['Prefer'] = $prefer;
        }
        return $this->get($endpoint, [], $headers);
    }

    /**
     * Delete bank account
     *
     * @param int $userId
     * @param int $bankAccountId
     * @return array
     */
    public function deleteUserBankAccount(int $userId, int $bankAccountId): array
    {
        $endpoint = "/v3/users/$userId/bank-information/$bankAccountId";
        return $this->delete($endpoint);
    }

    /**
     * Update user bank account
     *
     * @param int $bankAccountId
     * @param UpdateUserBankInformationSchema $request
     * @return array
     */
    public function updateUserBankAccount(int $bankAccountId, UpdateUserBankInformationSchema $request): array
    {
        $endpoint = "/v3/bank-information/$bankAccountId";
        $data = $request->toArray();
        return $this->patch($endpoint, $data);
    }

    /**
     * Update user verification
     *
     * @param int $userId
     * @param UserVerificationSchema $request
     * @return PrivateUserResponse
     */
    public function updateUserVerification(int $userId, UserVerificationSchema $request): PrivateUserResponse
    {
        $endpoint = "/v3/users/$userId/verification-request";
        $data = $request->toArray();
        $response = $this->patch($endpoint, $data);
        return PrivateUserResponse::fromArray($response);
    }

    /**
     * Verify user bank account
     *
     * @param int $userId
     * @param UserVerifyBankInformationSchema $request
     * @return array
     */
    public function verifyUserBankAccount(int $userId, UserVerifyBankInformationSchema $request): array
    {
        $endpoint = "/v3/users/$userId/bank-information/verify";
        return $this->post($endpoint, $request->toArray());
    }

    /**
     * Verify user bank account OTP
     *
     * @param int $userId
     * @param UserCardsOtpSchema $request
     * @return array
     */
    public function verifyUserBankAccountOtp(int $userId, UserCardsOtpSchema $request): array
    {
        $endpoint = "/v3/users/$userId/bank-information/verify-otp";
        return $this->post($endpoint, $request->toArray());
    }

    /**
     * Get all categories
     *
     * @return CategoriesResponse
     */
    public function getCategories(): CategoriesResponse
    {
        $endpoint = "/v3/categories";
        $response = $this->get($endpoint);
        return CategoriesResponse::fromArray($response);
    }

    /**
     * Get specific category
     *
     * @param int $categoryId
     * @return CategoryResponse
     */
    public function getCategory(int $categoryId): CategoryResponse
    {
        $endpoint = "/v3/categories/$categoryId";
        $response = $this->get($endpoint);
        return CategoryResponse::fromArray($response);
    }

    /**
     * Get category attributes
     *
     * @param int $categoryId
     * @param int|null $productId
     * @param int|null $vendorId
     * @param bool $excludeMultiSelects
     * @return AttributesResponse
     */
    public function getCategoryAttributes(
        int  $categoryId,
        ?int $productId = null,
        ?int $vendorId = null,
        bool $excludeMultiSelects = true
    ): AttributesResponse
    {
        $endpoint = "/v3/categories/$categoryId/attributes";
        $params = [
            'exclude_multi_selects' => $excludeMultiSelects
        ];

        if ($productId !== null) {
            $params['product_id'] = $productId;
        }
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }

        $response = $this->get($endpoint, $params);
        return AttributesResponse::fromArray($response);
    }
}