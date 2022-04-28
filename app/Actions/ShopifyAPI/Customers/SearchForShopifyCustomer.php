<?php

namespace App\Actions\ShopifyAPI\Customers;

use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchForShopifyCustomer
{
    use AsAction;

    public function handle(string $field, string $value) : array | false
    {
        $results = false;

        // Get the proper response
        $shop_url = config('shopify.shop_url');
        $token = config('shopify.access_token');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $token
        ])->get('https://'.$shop_url.'/admin/api/2022-04/customers/search.json', [$field => $value]);

        $array_response = json_decode($response->body(), true);

        if($array_response)
        {
            $results = $array_response;
        }

        return $results;
    }
}
