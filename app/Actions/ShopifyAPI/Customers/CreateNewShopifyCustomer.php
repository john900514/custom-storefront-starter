<?php

namespace App\Actions\ShopifyAPI\Customers;

use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewShopifyCustomer
{
    use AsAction;

    public function handle(array $body) : array | false
    {
        $results = false;

        // Get the proper response
        $shop_url = config('shopify.shop_url');
        $token = config('shopify.access_token');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $token
        ])->post('https://'.$shop_url.'/admin/api/2022-04/customers.json', ['customer' => $body]);

        $array_response = json_decode($response->body(), true);

        if($array_response)
        {
            $results = $array_response;
        }

        return $results;
    }
}
