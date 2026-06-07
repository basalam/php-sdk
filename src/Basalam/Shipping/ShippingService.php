<?php

namespace Basalam\Shipping;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Shipping\Models\BatchUpdateProfileProductsFreeShippingRulesRequest;
use Basalam\Shipping\Models\BatchUpdateProfileProductsFreeShippingRulesResponse;
use Basalam\Shipping\Models\BulkResponseCarrierResponse;
use Basalam\Shipping\Models\BulkResponseNestedLocationResponse;
use Basalam\Shipping\Models\BulkResponseVendorCarrierResponse;
use Basalam\Shipping\Models\CreateCarrierRateRequest;
use Basalam\Shipping\Models\CreateCarrierRatesRequest;
use Basalam\Shipping\Models\CreateProfileProductResponse;
use Basalam\Shipping\Models\CreateProfileProductsRequest;
use Basalam\Shipping\Models\CreateProfileRequest;
use Basalam\Shipping\Models\CreateProfileZoneRequest;
use Basalam\Shipping\Models\CreateZoneOwnRatesRequest;
use Basalam\Shipping\Models\DeliveryEstimatesListResponse;
use Basalam\Shipping\Models\GetProfileProductFreeShippingRulesResponse;
use Basalam\Shipping\Models\OffsetPaginationResponseZoneCarrierResponse;
use Basalam\Shipping\Models\OffsetPaginationResponseZoneListResponse;
use Basalam\Shipping\Models\OffsetPaginationResponseZonesOwnRatesResponse;
use Basalam\Shipping\Models\OkResponse;
use Basalam\Shipping\Models\ProductsResponseCursorPagination;
use Basalam\Shipping\Models\ProfileListPaginationResponse;
use Basalam\Shipping\Models\ProfileProductsResponseCursorPagination;
use Basalam\Shipping\Models\ProfileResponse;
use Basalam\Shipping\Models\ProfileStrategyRequest;
use Basalam\Shipping\Models\ProfileStrategyResponse;
use Basalam\Shipping\Models\PublicProductZonesResponse;
use Basalam\Shipping\Models\UpdateCarrierRateRequest;
use Basalam\Shipping\Models\UpdateOwnRatesRequest;
use Basalam\Shipping\Models\UpdateProfileRequest;
use Basalam\Shipping\Models\UpdateProfileZoneRequest;
use Basalam\Shipping\Models\ZoneCarriersResponse;
use Basalam\Shipping\Models\ZoneResponse;
use Basalam\Shipping\Models\ZonesOwnRatesResponse;

/**
 * Client for the Basalam Shipping service API.
 */
class ShippingService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'shipping');
    }

    /**
     * Read Vendor Profiles.
     *
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @param int|null $vendorId vendor_id
     * @return ProfileListPaginationResponse
     */
    public function readVendorProfiles(?int $page = null, ?int $perPage = null, ?int $vendorId = null): ProfileListPaginationResponse
    {
        $endpoint = "/v1/shipping/profiles";
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }
        $response = $this->get($endpoint, $params, []);
        return ProfileListPaginationResponse::fromArray($response);
    }

    /**
     * Create Profile.
     *
     * @param CreateProfileRequest $request Request payload
     * @return ProfileResponse
     */
    public function createProfile(CreateProfileRequest $request): ProfileResponse
    {
        $endpoint = "/v1/shipping/profiles";
        $response = $this->post($endpoint, $request->toArray(), [], []);
        return ProfileResponse::fromArray($response);
    }

    /**
     * Update Profile.
     *
     * @param int|string $profileId profile_id
     * @param UpdateProfileRequest $request Request payload
     * @return ProfileResponse
     */
    public function updateProfile(int $profileId, UpdateProfileRequest $request): ProfileResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}";
        $response = $this->patch($endpoint, $request->toArray(), []);
        return ProfileResponse::fromArray($response);
    }

    /**
     * Get Profile.
     *
     * @param int|string $profileId profile_id
     * @return ProfileResponse
     */
    public function getProfile(int $profileId): ProfileResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}";
        $response = $this->get($endpoint, [], []);
        return ProfileResponse::fromArray($response);
    }

    /**
     * Delete Profile.
     *
     * @param int|string $profileId profile_id
     * @return OkResponse
     */
    public function deleteProfile(int $profileId): OkResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}";
        $response = $this->delete($endpoint, [], [], []);
        return OkResponse::fromArray($response);
    }

    /**
     * Read Profile Zones.
     *
     * @param int|string $profileId profile_id
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @return OffsetPaginationResponseZoneListResponse
     */
    public function readProfileZones(int $profileId, ?int $page = null, ?int $perPage = null): OffsetPaginationResponseZoneListResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}/zones";
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        $response = $this->get($endpoint, $params, []);
        return OffsetPaginationResponseZoneListResponse::fromArray($response);
    }

    /**
     * Create Profile Zone.
     *
     * @param int|string $profileId profile_id
     * @param CreateProfileZoneRequest $request Request payload
     * @return ZoneResponse
     */
    public function createProfileZone(int $profileId, CreateProfileZoneRequest $request): ZoneResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}/zones";
        $response = $this->post($endpoint, $request->toArray(), [], []);
        return ZoneResponse::fromArray($response);
    }

    /**
     * Read Profile Uncovered Locations.
     *
     * @param int|string $profileId profile_id
     * @return BulkResponseNestedLocationResponse
     */
    public function readProfileUncoveredLocations(int $profileId): BulkResponseNestedLocationResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}/zones/unrecovered-locations";
        $response = $this->get($endpoint, [], []);
        return BulkResponseNestedLocationResponse::fromArray($response);
    }

    /**
     * Get Profile Products.
     *
     * @param int|string $profileId profile_id
     * @param string|null $productTitleLike product.title[like]
     * @param array|null $neverFreeZoneIds never_free_zone_ids
     * @param array|null $conditionalZoneIds conditional_zone_ids
     * @param string|null $sort sort
     * @param int|null $perPage per_page
     * @param string|null $cursor cursor
     * @return ProfileProductsResponseCursorPagination
     */
    public function getProfileProducts(int $profileId, ?string $productTitleLike = null, ?array $neverFreeZoneIds = null, ?array $conditionalZoneIds = null, ?string $sort = null, ?int $perPage = null, ?string $cursor = null): ProfileProductsResponseCursorPagination
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}/products";
        $params = [];
        if ($productTitleLike !== null) {
            $params['product.title[like]'] = $productTitleLike;
        }
        if ($neverFreeZoneIds !== null) {
            $params['never_free_zone_ids'] = $neverFreeZoneIds;
        }
        if ($conditionalZoneIds !== null) {
            $params['conditional_zone_ids'] = $conditionalZoneIds;
        }
        if ($sort !== null) {
            $params['sort'] = $sort;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        $response = $this->get($endpoint, $params, []);
        return ProfileProductsResponseCursorPagination::fromArray($response);
    }

    /**
     * Create Profile Products.
     *
     * @param int|string $profileId profile_id
     * @param CreateProfileProductsRequest $request Request payload
     * @return CreateProfileProductResponse
     */
    public function createProfileProducts(int $profileId, CreateProfileProductsRequest $request): CreateProfileProductResponse
    {
        $endpoint = "/v1/shipping/profiles/{$profileId}/products";
        $response = $this->post($endpoint, $request->toArray(), [], []);
        return CreateProfileProductResponse::fromArray($response);
    }

    /**
     * Get Zone.
     *
     * @param int|string $zoneId zone_id
     * @return ZoneResponse
     */
    public function getZone(int $zoneId): ZoneResponse
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}";
        $response = $this->get($endpoint, [], []);
        return ZoneResponse::fromArray($response);
    }

    /**
     * Update Zone.
     *
     * @param int|string $zoneId zone_id
     * @param UpdateProfileZoneRequest $request Request payload
     * @return ZoneResponse
     */
    public function updateZone(int $zoneId, UpdateProfileZoneRequest $request): ZoneResponse
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}";
        $response = $this->patch($endpoint, $request->toArray(), []);
        return ZoneResponse::fromArray($response);
    }

    /**
     * Delete Zone.
     *
     * @param int|string $zoneId zone_id
     * @return OkResponse
     */
    public function deleteZone(int $zoneId): OkResponse
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}";
        $response = $this->delete($endpoint, [], [], []);
        return OkResponse::fromArray($response);
    }

    /**
     * Create Zone Carrier Rate.
     *
     * @param int|string $zoneId zone_id
     * @param CreateCarrierRateRequest $request Request payload
     * @return array
     */
    public function createZoneCarrierRate(int $zoneId, CreateCarrierRateRequest $request): array
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}/carrier-rates";
        return $this->post($endpoint, $request->toArray(), [], []);
    }

    /**
     * Set Zone Carrier Rates.
     *
     * @param int|string $zoneId zone_id
     * @param CreateCarrierRatesRequest $request Request payload
     * @return array
     */
    public function setZoneCarrierRates(int $zoneId, CreateCarrierRatesRequest $request): array
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}/carrier-rates";
        return $this->put($endpoint, $request->toArray(), []);
    }

    /**
     * Read Zone Carriers.
     *
     * @param int|string $zoneId zone_id
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @return OffsetPaginationResponseZoneCarrierResponse
     */
    public function readZoneCarriers(int $zoneId, ?int $page = null, ?int $perPage = null): OffsetPaginationResponseZoneCarrierResponse
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}/carrier-rates";
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        $response = $this->get($endpoint, $params, []);
        return OffsetPaginationResponseZoneCarrierResponse::fromArray($response);
    }

    /**
     * Create Zone Own Rates.
     *
     * @param int|string $zoneId zone_id
     * @param CreateZoneOwnRatesRequest $request Request payload
     * @return array
     */
    public function createZoneOwnRates(int $zoneId, CreateZoneOwnRatesRequest $request): array
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}/own-rates";
        return $this->post($endpoint, $request->toArray(), [], []);
    }

    /**
     * Read Zone Own Rates.
     *
     * @param int|string $zoneId zone_id
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @return OffsetPaginationResponseZonesOwnRatesResponse
     */
    public function readZoneOwnRates(int $zoneId, ?int $page = null, ?int $perPage = null): OffsetPaginationResponseZonesOwnRatesResponse
    {
        $endpoint = "/v1/shipping/zones/{$zoneId}/own-rates";
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        $response = $this->get($endpoint, $params, []);
        return OffsetPaginationResponseZonesOwnRatesResponse::fromArray($response);
    }

    /**
     * Get Delivery Estimates.
     *
     * @param int|null $vendorId vendor_id
     * @return DeliveryEstimatesListResponse
     */
    public function getDeliveryEstimates(?int $vendorId = null): DeliveryEstimatesListResponse
    {
        $endpoint = "/v1/shipping/own-rates/delivery-estimates";
        $params = [];
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }
        $response = $this->get($endpoint, $params, []);
        return DeliveryEstimatesListResponse::fromArray($response);
    }

    /**
     * Get Own Rate.
     *
     * @param int|string $ownRateId own_rate_id
     * @return ZonesOwnRatesResponse
     */
    public function getOwnRate(int $ownRateId): ZonesOwnRatesResponse
    {
        $endpoint = "/v1/shipping/own-rates/{$ownRateId}";
        $response = $this->get($endpoint, [], []);
        return ZonesOwnRatesResponse::fromArray($response);
    }

    /**
     * Update Own Rates.
     *
     * @param int|string $ownRateId own_rate_id
     * @param UpdateOwnRatesRequest $request Request payload
     * @return array
     */
    public function updateOwnRates(int $ownRateId, UpdateOwnRatesRequest $request): array
    {
        $endpoint = "/v1/shipping/own-rates/{$ownRateId}";
        return $this->put($endpoint, $request->toArray(), []);
    }

    /**
     * Delete Own Rate.
     *
     * @param int|string $ownRateId own_rate_id
     * @return OkResponse
     */
    public function deleteOwnRate(int $ownRateId): OkResponse
    {
        $endpoint = "/v1/shipping/own-rates/{$ownRateId}";
        $response = $this->delete($endpoint, [], [], []);
        return OkResponse::fromArray($response);
    }

    /**
     * Read Carriers.
     *
     * @return BulkResponseCarrierResponse
     */
    public function readCarriers(): BulkResponseCarrierResponse
    {
        $endpoint = "/v1/shipping/carriers";
        $response = $this->get($endpoint, [], []);
        return BulkResponseCarrierResponse::fromArray($response);
    }

    /**
     * Read Vendor Carriers.
     *
     * @param int|null $status status
     * @param int|null $vendorId vendor_id
     * @param string|null $prefer prefer header
     * @return BulkResponseVendorCarrierResponse
     */
    public function readVendorCarriers(?int $status = null, ?int $vendorId = null, ?string $prefer = null): BulkResponseVendorCarrierResponse
    {
        $endpoint = "/v1/shipping/vendor-carriers";
        $headers = [];
        if ($prefer !== null) {
            $headers['prefer'] = $prefer;
        }
        $params = [];
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }
        $response = $this->get($endpoint, $params, $headers);
        return BulkResponseVendorCarrierResponse::fromArray($response);
    }

    /**
     * Get Carrier Rate.
     *
     * @param int|string $carrierRateId carrier_rate_id
     * @return ZoneCarriersResponse
     */
    public function getCarrierRate(int $carrierRateId): ZoneCarriersResponse
    {
        $endpoint = "/v1/shipping/carrier-rates/{$carrierRateId}";
        $response = $this->get($endpoint, [], []);
        return ZoneCarriersResponse::fromArray($response);
    }

    /**
     * Update Carrier Rate.
     *
     * @param int|string $carrierRateId carrier_rate_id
     * @param UpdateCarrierRateRequest $request Request payload
     * @return ZoneCarriersResponse
     */
    public function updateCarrierRate(int $carrierRateId, UpdateCarrierRateRequest $request): ZoneCarriersResponse
    {
        $endpoint = "/v1/shipping/carrier-rates/{$carrierRateId}";
        $response = $this->patch($endpoint, $request->toArray(), []);
        return ZoneCarriersResponse::fromArray($response);
    }

    /**
     * Delete Carrier Rate.
     *
     * @param int|string $carrierRateId carrier_rate_id
     * @return OkResponse
     */
    public function deleteCarrierRate(int $carrierRateId): OkResponse
    {
        $endpoint = "/v1/shipping/carrier-rates/{$carrierRateId}";
        $response = $this->delete($endpoint, [], [], []);
        return OkResponse::fromArray($response);
    }

    /**
     * Read Profile Products.
     *
     * @param int|null $profileIdEq profile_id[eq]
     * @param int|null $profileIdNe profile_id[ne]
     * @param string|null $productTitleLike product.title[like]
     * @param string|null $sort sort
     * @param int|null $perPage per_page
     * @param int|null $vendorId vendor_id
     * @param string|null $cursor cursor
     * @return ProductsResponseCursorPagination
     */
    public function readProfileProducts(?int $profileIdEq = null, ?int $profileIdNe = null, ?string $productTitleLike = null, ?string $sort = null, ?int $perPage = null, ?int $vendorId = null, ?string $cursor = null): ProductsResponseCursorPagination
    {
        $endpoint = "/v1/shipping/profile-products";
        $params = [];
        if ($profileIdEq !== null) {
            $params['profile_id[eq]'] = $profileIdEq;
        }
        if ($profileIdNe !== null) {
            $params['profile_id[ne]'] = $profileIdNe;
        }
        if ($productTitleLike !== null) {
            $params['product.title[like]'] = $productTitleLike;
        }
        if ($sort !== null) {
            $params['sort'] = $sort;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        $response = $this->get($endpoint, $params, []);
        return ProductsResponseCursorPagination::fromArray($response);
    }

    /**
     * Delete Profile Product.
     *
     * @param int|string $productId product_id
     * @return OkResponse
     */
    public function deleteProfileProduct(int $productId): OkResponse
    {
        $endpoint = "/v1/shipping/profile-products/{$productId}";
        $response = $this->delete($endpoint, [], [], []);
        return OkResponse::fromArray($response);
    }

    /**
     * دریافت تنظیمات ارسال رایگان محصول.
     *
     * @param int|string $productId product_id
     * @return GetProfileProductFreeShippingRulesResponse
     */
    public function getProfileProductFreeShippingRules(int $productId): GetProfileProductFreeShippingRulesResponse
    {
        $endpoint = "/v1/shipping/profile-products/{$productId}/free-shipping-rules";
        $response = $this->get($endpoint, [], []);
        return GetProfileProductFreeShippingRulesResponse::fromArray($response);
    }

    /**
     * بروزرسانی دسته‌ای قوانین ارسال رایگان محصولات.
     *
     * @param BatchUpdateProfileProductsFreeShippingRulesRequest $request Request payload
     * @return BatchUpdateProfileProductsFreeShippingRulesResponse
     */
    public function batchUpdateProfileProductsFreeShippingRules(BatchUpdateProfileProductsFreeShippingRulesRequest $request): BatchUpdateProfileProductsFreeShippingRulesResponse
    {
        $endpoint = "/v1/shipping/profile-products/free-shipping-rules";
        $response = $this->patch($endpoint, $request->toArray(), []);
        return BatchUpdateProfileProductsFreeShippingRulesResponse::fromArray($response);
    }

    /**
     * Get Product Shipping Info.
     *
     * @param int|string $productId product_id
     * @return PublicProductZonesResponse
     */
    public function getProductShippingInfo(int $productId): PublicProductZonesResponse
    {
        $endpoint = "/v1/shipping/profile-products/{$productId}/shipping-info";
        $response = $this->get($endpoint, [], []);
        return PublicProductZonesResponse::fromArray($response);
    }

    /**
     * Read Locations.
     *
     * @return BulkResponseNestedLocationResponse
     */
    public function readLocations(): BulkResponseNestedLocationResponse
    {
        $endpoint = "/v1/shipping/locations";
        $response = $this->get($endpoint, [], []);
        return BulkResponseNestedLocationResponse::fromArray($response);
    }

    /**
     * Read Profile Strategy.
     *
     * @param int|null $vendorId vendor_id
     * @return ProfileStrategyResponse
     */
    public function readProfileStrategy(?int $vendorId = null): ProfileStrategyResponse
    {
        $endpoint = "/v1/shipping/profile-strategy";
        $params = [];
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }
        $response = $this->get($endpoint, $params, []);
        return ProfileStrategyResponse::fromArray($response);
    }

    /**
     * Create Profile Strategy.
     *
     * @param ProfileStrategyRequest $request Request payload
     * @return ProfileStrategyResponse
     */
    public function createProfileStrategy(ProfileStrategyRequest $request): ProfileStrategyResponse
    {
        $endpoint = "/v1/shipping/profile-strategy";
        $response = $this->put($endpoint, $request->toArray(), []);
        return ProfileStrategyResponse::fromArray($response);
    }

}
