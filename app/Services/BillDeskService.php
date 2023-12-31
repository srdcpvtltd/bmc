<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BillDeskService
{
    public function createOrder($payment)
    {
        // Make POST request to BillDesk API to create an order
        try {

            $headers = ["alg" => "HS256", "clientid" => config('services.bill_desk.client_id'), 'typ' => 'JWT'];

            $dateTime = Carbon::now()->setTimezone('Asia/Kolkata');
            $formattedDateTime = $dateTime->format('Y-m-d\TH:i:sP');
    
            $orderDate = $formattedDateTime;
            $payload = [
                "mercid" => config('services.bill_desk.merchant_id'),
                "orderid" => rand(1111, 9999),
                "amount" => $payment->amount,
                "order_date" => $orderDate,
                "currency" => "356",
                "ru" => url('success'),
                "additional_info" => [
                    "additional_info1" => $payment->name,
                    "additional_info2" => $payment->type,
                ],
                "itemcode" => "DIRECT",
                "device" => [
                    "init_channel" => "internet",
                    "ip" => "89.117.157.230",
                    "accept_header" => "text/html",
                    "user_agent" => request()->header('User-Agent'),
                ]
            ];
            Log::info("Payload Billdesk : ".json_encode($payload,1));
            $header = base64_encode(json_encode($headers));
            $payload = base64_encode(json_encode($payload));
            $signature = hash_hmac('sha256', "$header.$payload", 'GArYKL0QdCwGnYc5qYHFyoN8dB9OjN6o', true);
            $signature = base64_encode($signature);
            $curl_payload = "$header.$payload.$signature";

            $ch = curl_init(config('services.bill_desk.order_url'));
    
            $tracid=rand(1111,9999);
    
            $ch_headers = array(
                "Content-Type: application/jose",
                "accept: application/jose",
                "BD-Traceid:".$tracid,
                "BD-Timestamp: ".Carbon::now()->setTimezone('Asia/Kolkata')->timestamp
            );
            Log::info("Header Billdesk : ".json_encode($ch_headers,1));
            Log::info("Payload Encrypted Billdesk : ".json_encode($curl_payload,1));
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $ch_headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $curl_payload);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $result = curl_exec($ch);
            curl_close($ch);
            list(, $response,) = explode('.', $result);

            $result_decoded = base64_decode(strtr($response, '-_', '+/'));
            $result_array =json_decode($result_decoded, true);

            if($result_array['status'] == "ACTIVE") {
                $order_id= $result_array['bdorderid'];
                $original_order_id= $result_array['orderid'];
                $autharray= $result_array['links'][1];
                $headersArray= $autharray['headers'];
                $authorization_token=$headersArray['authorization'];
                return [
                    'success'=>true,
                    'authorization_token' => $authorization_token,
                    'order_id' => $order_id,
                    'original_order_id' => $original_order_id,
                ];
            } else { // Response error
                Log::info("Response Error Billdesk : ".$result_array['message']);
                return [
                    'success'=>false,
                    'error' => $result_array['message']
                ];
            }
                    
           
        } catch (\Exception $e) {
            Log::info("Exception Error Billdesk : ". $e->getMessage());
            // Handle API request error
            return ['success'=>false,'error' => $e->getMessage()];
        }
    }
}
