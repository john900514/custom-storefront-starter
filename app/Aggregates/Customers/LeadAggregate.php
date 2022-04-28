<?php

namespace App\Aggregates\Customers;

use App\Aggregates\Customers\LeadPartials\ShopifyCustomerPartial;
use App\StorableEvents\Customers\Leads\LeadCreated;
use App\StorableEvents\Customers\Leads\SegmentAnonymousIdCaptured;
use Shopify\Rest\Admin2021_07\Shop;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class LeadAggregate extends AggregateRoot
{
    protected string|null $email      = null;
    protected string|null $first_name = null;
    protected string|null $last_name  = null;
    protected string|null $phone      = null;
    protected bool $consent           = false;
    protected string|null $segment_id = null;
    protected string|null $type = null;

    protected array $activity = [];
    protected string|null $conversion_id = null;
    protected string|null $shopify_customer_id = null;
    protected array $other_segment_anonymous_ids = [];
    // @todo - Need an Aggregate Partial for the cart;

    protected ShopifyCustomerPartial $shopify_customer;

    public function __construct()
    {
        $this->shopify_customer = new ShopifyCustomerPartial($this);
    }

    public function applyLeadCreated(LeadCreated $event)
    {
        $this->type = $event->type;
        $this->first_name = $event->details['firstName'];
        $this->last_name = $event->details['lastName'];
        $this->email = $event->details['email'];
        $this->phone = $event->details['phone'];
        $this->consent = $event->details['consent'];
    }

    public function applySegmentAnonymousIdCaptured(SegmentAnonymousIdCaptured $event)
    {
        $this->segment_id = $event->anonymous_id;
    }

    public function captureLead(string $type, array $details) : self
    {
        $this->recordThat(new LeadCreated($this->uuid(), $type, $details));
        return $this;
    }

    public function captureSegmentAnonymousId(string $anonymous_id)  : self
    {
        $this->recordThat(new SegmentAnonymousIdCaptured($this->uuid(), $anonymous_id));
        return $this;
    }

    public function storeShopifyCustomerData(string $shopify_customer_id, array $customer_details) : self
    {
        $this->shopify_customer->storeShopifyCustomerData($shopify_customer_id, $customer_details);
        return $this;
    }

    public function storeShopifyCustomerRejection(array $response) : self
    {
        return $this;
    }

    public function getEmail() : string|null
    {
        return $this->email;
    }

    public function getFirstName() : string|null
    {
        return $this->first_name;
    }

    public function getLastName() : string|null
    {
        return $this->last_name;
    }

    public function getPhone() : string|null
    {
        return $this->phone;
    }

    public function getConsent() : bool
    {
        return $this->consent;
    }
}
