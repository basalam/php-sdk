<?php

namespace Basalam\Auth;

class Scope
{
    const ALL = '*';

    // Order processing
    const ORDER_PROCESSING = 'order-processing';

    // Vendor profile scopes
    const VENDOR_PROFILE_READ = 'vendor.profile.read';
    const VENDOR_PROFILE_WRITE = 'vendor.profile.write';

    // Customer profile scopes
    const CUSTOMER_PROFILE_READ = 'customer.profile.read';
    const CUSTOMER_PROFILE_WRITE = 'customer.profile.write';

    // Vendor product scopes
    const VENDOR_PRODUCT_READ = 'vendor.product.read';
    const VENDOR_PRODUCT_WRITE = 'vendor.product.write';

    // Customer order scopes
    const CUSTOMER_ORDER_READ = 'customer.order.read';
    const CUSTOMER_ORDER_WRITE = 'customer.order.write';

    // Vendor parcel scopes
    const VENDOR_PARCEL_READ = 'vendor.parcel.read';
    const VENDOR_PARCEL_WRITE = 'vendor.parcel.write';

    // Customer wallet scopes
    const CUSTOMER_WALLET_READ = 'customer.wallet.read';
    const CUSTOMER_WALLET_WRITE = 'customer.wallet.write';

    // Customer chat scopes
    const CUSTOMER_CHAT_READ = 'customer.chat.read';
    const CUSTOMER_CHAT_WRITE = 'customer.chat.write';
}