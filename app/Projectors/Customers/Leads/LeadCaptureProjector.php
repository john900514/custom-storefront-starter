<?php

namespace App\Projectors\Customers\Leads;

use App\Models\Customers\Details\LeadDetail;
use App\Models\Customers\Lead;
use App\StorableEvents\Customers\Leads\LeadCreated;
use App\StorableEvents\Shopify\Customers\NewShopifyCustomerCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class LeadCaptureProjector extends Projector
{
    public function onLeadCreated(LeadCreated $event)
    {
        $lead = Lead::create($event->details);
        $lead->update([
            'id' => $event->lead_id,
            'first_name' => $event->details['firstName'],
            'last_name' => $event->details['lastName'],
        ]);
    }

    public function onNewShopifyCustomerCreated(NewShopifyCustomerCreated $event)
    {
        $detail = LeadDetail::firstOrCreate([
            'lead_id' => $event->lead_id,
            'field' => 'shopify_customer',
            'value' => $event->shopify_customer_id
        ]);
        $detail->update(['misc' => $event->customer_details]);
    }
}
