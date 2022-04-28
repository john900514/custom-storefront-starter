<?php

namespace App\Actions\Customers\Leads;

use App\Aggregates\Customers\LeadAggregate;
use Lorisleiva\Actions\Concerns\AsAction;
use Ramsey\Uuid\Uuid;

class PostLead
{
    use AsAction;

    public function rules() : array
    {
        return [
            'firstName'   => ['bail', 'required', 'string'],
            'lastName'    => ['bail', 'required', 'string'],
            'email'       => ['bail', 'required', 'email:rfc,dns', 'unique:leads,email'],
            'phone'       => ['bail', 'required', 'numeric', 'digits:10', 'unique:leads,phone'],
            'consent'     => ['bail', 'required', 'bool'],
            'type'        => ['bail', 'required', 'string'],
            'anonymousId' => ['sometimes', 'required']
        ];
    }
    public function handle(array $details) : string | false | array
    {
        $results = false;
        $uuid = Uuid::uuid4()->toString();

        try {

            $aggy = LeadAggregate::retrieve($uuid);
            $type = $details['type'];
            $anonymous_id = $details['anonymousId'] ?? null;
            unset($details['type']);
            unset($details['anonymousId']);
            // Use the Lead Aggregate to store a lead with a LeadCreated Event and applier
            $aggy = $aggy->captureLead($type, $details);

            if(!is_null($anonymous_id))
            {
                $aggy = $aggy->captureSegmentAnonymousId($anonymous_id);
            }

            $aggy->persist();
            $results = [$uuid];
        }
        catch (\Exception $e) {
            $results = $e->getMessage();
        }
        /**
         * STEPS
         * 2.
         * 4. Save the lead in the projector
         * 5. Is there a segment Anonymous ID? Set up an Event and lead details projection
         * 6. Make a reactor
         * 7. Use the reactor to send the lead to Shopify
         * 8. Return the UUID to the user
         */

        return $results;
    }

    public function asController()
    {
        return $this->handle(request()->all());
    }

    public function jsonResponse($result)
    {
        $results = ['success' => false, 'reason' => 'Could not save your request. Please Try Again.'];
        $code = 500;

        if(is_array($result))
        {
            $results = ['success' => true, 'id' => $result[0]];
            $code = 200;
        }
        elseif(is_string($result))
        {
            $results['reason'] = $result;
        }

        return response($results, $code);
    }
}
