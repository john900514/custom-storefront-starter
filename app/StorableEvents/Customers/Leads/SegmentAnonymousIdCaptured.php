<?php

namespace App\StorableEvents\Customers\Leads;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class SegmentAnonymousIdCaptured extends ShouldBeStored
{
    public function __construct(public string $lead_id, public string $anonymous_id)
    {
    }
}
