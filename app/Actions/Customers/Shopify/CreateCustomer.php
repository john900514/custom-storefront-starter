<?php

namespace App\Actions\Customers\Shopify;

use App\Actions\SegmentAPI\Calls\SegmentTrack;
use App\Actions\ShopifyAPI\Customers\SearchForShopifyCustomer;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Aggregates\Customers\LeadAggregate;
use App\Actions\ShopifyAPI\Customers\CreateNewShopifyCustomer;

class CreateCustomer
{
    use AsAction;

    public function handle(string $lead_id)
    {
        $aggy = LeadAggregate::retrieve($lead_id);
        $body = [
            'email' => $aggy->getEmail(),
            'first_name' => $aggy->getFirstName(),
            'last_name' => $aggy->getLastName(),
            'phone' => $aggy->getPhone(),
            'accepts_marketing' => $aggy->getConsent()
        ];

        $response = CreateNewShopifyCustomer::run($body);

        if(array_key_exists('customer', $response))
        {
            // Log successes in the lead aggy here.
            // Pull the shopify ID
            $shopify_id = $response['customer']['id'];
            // trigger StoreShopifyCustomerData
            $aggy = $aggy->storeShopifyCustomerData($shopify_id, $response);

            // Send this to Segment as Well (track - Shopify Customer)
            SegmentTrack::run($lead_id, 'Shopify Customer', $response);
        }
        elseif(array_key_exists('errors', $response))
        {
            $shopify_id = null;
            $first_response = $response;
            $new_response = null;
            // locate the shopify customer via ID via one of the errors if they are email or phone.
            foreach($first_response['errors'] as $field => $reason)
            {
                switch($field)
                {
                    case 'email':
                    case 'phone':
                    $new_response = SearchForShopifyCustomer::run($field, $body[$field]);
                    if(array_key_exists('customers', $new_response) && (count($new_response['customers']) > 0))
                    {
                        $shopify_id = $new_response['customers'][0]['id'];
                        $aggy = $aggy->storeShopifyCustomerData($shopify_id, $new_response['customers'][0]);
                        break;
                    }
                    break;
                }
            }

            if(is_null($shopify_id))
            {
                // if still not found, Log errors in the Lead Aggy here
                $aggy = $aggy->storeShopifyCustomerRejection($first_response);
                // Send this to Segment as Well as  Shopify Customer Rejection
                SegmentTrack::run($lead_id, 'Shopify Customer Rejection', $first_response);
            }
            else
            {
                // Send this to Segment as Well (track - Shopify Customer)
                SegmentTrack::run($lead_id, 'Shopify Customer', $new_response);
            }
        }
        else
        {
            // This is where bad responses get processed
            $aggy = $aggy->storeShopifyCustomerRejection($response);
            // Send this to Segment as Well as  Shopify Customer Rejection
            SegmentTrack::run($lead_id, 'Shopify Customer Rejection', $response);
        }

        $aggy->persist();
    }
}
