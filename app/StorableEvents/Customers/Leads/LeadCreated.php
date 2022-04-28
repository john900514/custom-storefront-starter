<?php

namespace App\StorableEvents\Customers\Leads;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class LeadCreated extends ShouldBeStored
{
    public function __construct(public string $lead_id, public string $type, public array $details)
    {
    }
}
