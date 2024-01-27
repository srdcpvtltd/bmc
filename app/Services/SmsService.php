<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function sendSMS($phone)
    {
        // format number required by msg 91
        $to = '91' . str_replace(['/', '(', ')', ' ', '-'], '', $phone);
        try {
            
            $client = new Client();
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{
                    "template_id":"650d9bf5d6fc0549b3070583",
                    "short_url":"1 (On) or 0 (Off)",
                    "recipients":[{"mobiles":'.$to.',"VAR1":"VALUE1","VAR2":"VALUE2"}]}',

              'headers' => [
                'accept' => 'application/json',
                'authkey' => '233158AfWDBTKZ65b28419P1',
                'content-type' => 'application/json',
              ],
            ]);
            if($response->getStatusCode() == 200)
            {
                Log::info('Response Form Send Sms Api Send Successfully ');
                return [
                    'success'=>true,
                    'message' => "Message Send Successfully.",
                ];
            }else{
                Log::info('Response Form Send Sms Api : Something went wrong. ');
                return [
                    'success'=>false,
                    'message' => "Something Went Wrong",
                ];
            }
        } catch (\Exception $e) {
            Log::error('error sending email Exception: ' . $e->getMessage());
            return [
                'success'=>false,
                'message' => $e->getMessage(),
            ];
        }
    }
    public function sendWhatsappSMS($phone)
    {
        // format number required by msg 91
        $to = '91' . str_replace(['/', '(', ')', ' ', '-'], '', $phone);
        try {
            
            $client = new Client();
            $url = 'https://control.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/?content_type=text&integrated_number=917605926564&recipient_number='.$to.'&text="bmc"';
            $response = $client->request('POST',$url , [
                'headers' => [
                  'accept' => 'application/json',
                  'authkey' => '233158AfWDBTKZ65b28419P1',
                  'content-type' => 'application/json',
                ],
              ]);

              if($response->getStatusCode() == 200)
              {
                  return [
                      'success'=>true,
                      'message' => "Message Send Successfully.",
                  ];
              }else{
                  return [
                      'success'=>false,
                      'message' => "Something Went Wrong",
                  ];
              }
        } catch (Exception $e) {
            Log::error('error sending email Exception: ' . $e->getMessage());
            return [
                'success'=>false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
