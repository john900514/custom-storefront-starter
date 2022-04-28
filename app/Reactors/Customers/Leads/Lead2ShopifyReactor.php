<?php

namespace App\Reactors\Customers\Leads;

use App\Actions\Customers\Shopify\CreateCustomer;
use App\StorableEvents\Customers\Leads\LeadCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class Lead2ShopifyReactor extends Reactor implements ShouldQueue
{
    public function onLeadCreated(LeadCreated $event)
    {
        CreateCustomer::dispatch($event->lead_id)->onQueue('lave-shopify-'.env('APP_ENV'));
    }
}
