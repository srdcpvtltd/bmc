<?php

namespace App\Services;

use GuzzleHttp\Client;

class BillDeskService
{
    protected $client;

    protected $base_url  = "https://uat1.billdesk.com/";

    public function __construct()
    {
       //
    }

    public function createOrder(array $data)
    {
        // Make POST request to BillDesk API to create an order
        try {
            $this->client = new Client([
                'base_uri' => 'https://uat1.billdesk.com/u2/payments/ve1_2/',
                'headers' => [
                    'Authorization' => 'Bearer bmcorpuat',
                    'Accept' => 'application/json',
                ],
            ]);
            $response = $this->client->post('orders/create', [
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            // Handle API request error
            return ['error' => $e->getMessage()];
        }
    }
}
