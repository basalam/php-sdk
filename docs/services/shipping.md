# Shipping Service

Manage shipping configuration end-to-end with the Shipping Service. This service lets you work with shipping profiles,
zones, carriers, carrier-rates, own-rates, profile-products and free-shipping rules: create and update profiles, define
zones from locations, attach carriers and pricing, manage vendor own-rates and delivery estimates, and control
free-shipping behaviour per product.

## Table of Contents

- [Shipping Methods](#shipping-methods)
- [Examples](#examples)

## Shipping Methods

| Method                                                                                          | Description                                  | Parameters                                                                                                  |
|-------------------------------------------------------------------------------------------------|----------------------------------------------|------------------------------------------------------------------------------------------------------------|
| [`readVendorProfiles()`](#read-vendor-profiles-example)                                          | Read vendor shipping profiles                | `page`, `perPage`, `vendorId`                                                                               |
| [`createProfile()`](#create-profile-example)                                                     | Create a shipping profile                    | `request`                                                                                                   |
| `updateProfile()`                                                                                | Update a shipping profile                    | `profileId`, `request`                                                                                      |
| [`getProfile()`](#get-profile-example)                                                           | Get a shipping profile                       | `profileId`                                                                                                 |
| `deleteProfile()`                                                                                | Delete a shipping profile                    | `profileId`                                                                                                  |
| `readProfileZones()`                                                                             | Read zones of a profile                      | `profileId`, `page`, `perPage`                                                                              |
| [`createProfileZone()`](#create-profile-zone-example)                                            | Create a zone in a profile                   | `profileId`, `request`                                                                                      |
| `readProfileUncoveredLocations()`                                                                | Read uncovered locations of a profile        | `profileId`                                                                                                  |
| `getProfileProducts()`                                                                           | Get products of a profile                    | `profileId`, `productTitleLike`, `neverFreeZoneIds`, `conditionalZoneIds`, `sort`, `perPage`, `cursor`      |
| [`createProfileProducts()`](#create-profile-products-example)                                    | Add products to a profile                    | `profileId`, `request`                                                                                      |
| `getZone()`                                                                                      | Get a zone                                   | `zoneId`                                                                                                     |
| `updateZone()`                                                                                   | Update a zone                                | `zoneId`, `request`                                                                                         |
| `deleteZone()`                                                                                   | Delete a zone                                | `zoneId`                                                                                                     |
| [`createZoneCarrierRate()`](#create-zone-carrier-rate-example)                                   | Create a carrier rate for a zone             | `zoneId`, `request`                                                                                         |
| `setZoneCarrierRates()`                                                                          | Set (replace) carrier rates for a zone       | `zoneId`, `request`                                                                                         |
| `readZoneCarriers()`                                                                             | Read carrier rates of a zone                 | `zoneId`, `page`, `perPage`                                                                                 |
| `createZoneOwnRates()`                                                                           | Create own-rates for a zone                  | `zoneId`, `request`                                                                                         |
| `readZoneOwnRates()`                                                                             | Read own-rates of a zone                     | `zoneId`, `page`, `perPage`                                                                                 |
| `getDeliveryEstimates()`                                                                         | Get delivery estimates for own-rates         | `vendorId`                                                                                                  |
| `getOwnRate()`                                                                                   | Get an own-rate                              | `ownRateId`                                                                                                  |
| `updateOwnRates()`                                                                               | Update an own-rate                           | `ownRateId`, `request`                                                                                      |
| `deleteOwnRate()`                                                                                | Delete an own-rate                           | `ownRateId`                                                                                                  |
| [`readCarriers()`](#read-carriers-example)                                                       | Read available carriers                      | `None`                                                                                                       |
| `readVendorCarriers()`                                                                           | Read vendor carriers                         | `status`, `vendorId`, `prefer`                                                                              |
| `getCarrierRate()`                                                                               | Get a carrier rate                           | `carrierRateId`                                                                                              |
| `updateCarrierRate()`                                                                            | Update a carrier rate                        | `carrierRateId`, `request`                                                                                  |
| `deleteCarrierRate()`                                                                            | Delete a carrier rate                        | `carrierRateId`                                                                                              |
| `readProfileProducts()`                                                                          | Read profile-products                        | `profileIdEq`, `profileIdNe`, `productTitleLike`, `sort`, `perPage`, `vendorId`, `cursor`                  |
| `deleteProfileProduct()`                                                                         | Delete a profile-product                     | `productId`                                                                                                  |
| `getProfileProductFreeShippingRules()`                                                           | Get free-shipping rules of a product         | `productId`                                                                                                  |
| `batchUpdateProfileProductsFreeShippingRules()`                                                  | Batch update free-shipping rules             | `request`                                                                                                   |
| `getProductShippingInfo()`                                                                       | Get public shipping info of a product        | `productId`                                                                                                  |
| `readLocations()`                                                                                | Read available locations                     | `None`                                                                                                       |
| `readProfileStrategy()`                                                                          | Read profile strategy                        | `vendorId`                                                                                                  |
| `createProfileStrategy()`                                                                        | Create/update profile strategy               | `request`                                                                                                   |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(token: "your_access_token");
$client = new BasalamClient(auth: $auth);
```

### Read Vendor Profiles Example

```php
function readVendorProfilesExample()
{
    global $client;

    $profiles = $client->shipping->readVendorProfiles(
        page: 1,
        perPage: 20,
        vendorId: 123
    );

    return $profiles;
}
```

### Create Profile Example

```php
use Basalam\Shipping\Models\CreateProfileRequest;

function createProfileExample()
{
    global $client;

    $profile = $client->shipping->createProfile(
        request: new CreateProfileRequest(
            title: "Standard Shipping",
            vendorId: 123
        )
    );

    return $profile;
}
```

### Get Profile Example

```php
function getProfileExample()
{
    global $client;

    $profile = $client->shipping->getProfile(profileId: 456);
    return $profile;
}
```

### Create Profile Zone Example

```php
use Basalam\Shipping\Models\CreateProfileZoneRequest;

function createProfileZoneExample()
{
    global $client;

    $zone = $client->shipping->createProfileZone(
        profileId: 456,
        request: new CreateProfileZoneRequest(
            locationIds: [1, 2, 3]
        )
    );

    return $zone;
}
```

### Create Profile Products Example

```php
use Basalam\Shipping\Models\CreateProfileProductsRequest;

function createProfileProductsExample()
{
    global $client;

    $result = $client->shipping->createProfileProducts(
        profileId: 456,
        request: new CreateProfileProductsRequest(
            productIds: [101, 102, 103],
            allProducts: false
        )
    );

    return $result;
}
```

### Create Zone Carrier Rate Example

```php
use Basalam\Shipping\Models\CreateCarrierRateRequest;

function createZoneCarrierRateExample()
{
    global $client;

    $rate = $client->shipping->createZoneCarrierRate(
        zoneId: 789,
        request: new CreateCarrierRateRequest(
            auto: false,
            vendorCarrierId: 55,
            baseCost: 30000,
            additionalCost: 5000,
            isFreightCollect: false,
            shippingDeadline: 3,
            shippingDeadlineUnit: "day"
        )
    );

    return $rate;
}
```

### Read Carriers Example

```php
function readCarriersExample()
{
    global $client;

    $carriers = $client->shipping->readCarriers();
    return $carriers;
}
```
