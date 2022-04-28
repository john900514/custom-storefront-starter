<?php

namespace App\Aggregates\Customers\LeadPartials;

use App\Aggregates\Customers\LeadAggregate;
use App\StorableEvents\Shopify\Customers\NewShopifyCustomerCreated;
use Spatie\EventSourcing\AggregateRoots\AggregatePartial;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ShopifyCustomerPartial extends AggregatePartial
{
    protected string|null $shopify_customer_id = null;
    protected array $shopify_customer_details = [];

    public function applyNewShopifyCustomerCreated(NewShopifyCustomerCreated $event)
    {
        $this->shopify_customer_id = $event->shopify_customer_id;
        $this->shopify_customer_details = $event->customer_details;
    }

    public function storeShopifyCustomerData(string $shopify_customer_id, array $customer_details) : self
    {
        $this->recordThat(new NewShopifyCustomerCreated($this->aggregateRootUuid(), $shopify_customer_id, $customer_details));
        return $this;
    }
}
