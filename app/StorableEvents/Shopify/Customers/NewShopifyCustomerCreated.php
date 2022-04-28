<?php

namespace App\StorableEvents\Shopify\Customers;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NewShopifyCustomerCreated extends ShouldBeStored
{
    public function __construct(public string $lead_id, public string $shopify_customer_id, public array $customer_details)
    {
    }
}
