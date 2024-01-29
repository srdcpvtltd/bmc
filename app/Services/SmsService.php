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
    public function sendWhatsappSMS($phone,$payment)
    {
        // format number required by msg 91
        $to = '91' . str_replace(['/', '(', ')', ' ', '-'], '', $phone);
        try {   
            $curl = curl_init();
            $parameters = [
                [
                    "type" => "text",
                    "text" => $payment->owner_name ? $payment->owner_name : $payment->shop->owner_name,
                ],
                [
                    "type" => "text",
                    "text" =>   $payment->month.' - '.$payment->year,
                ],
                [
                    "type" => "text",
                    "text" =>   $payment->amount,
                ],
            ];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "integrated_number": "917605926564",
                    "content_type": "template",
                    "payload": {
                        "to": '.$to.',
                        "type": "template",
                        "template": {
                            "name": "bmc",
                            "language": {
                                "code": "en",
                                "policy": "deterministic"
                            },
                            "components": [
                                {
                                    "type": "body",
                                    "parameters": '.json_encode($parameters).'
                                }
                            ]
                        },
                        "messaging_product": "whatsapp"
                    }
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'authkey: 233158AfWDBTKZ65b28419P1',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
            if($result && $result->status && $result->status == 'success'){
                Log::info('Response Form Send Whatsapp Sms Api Send Successfully ');
                return [
                    'success'=>true,
                    'message' => "Whatsapp Message Send Successfully.",
                ];
            }else{
                return [
                    'success'=>false,
                    'message' => "Something Went Wrong",
                ];
            }
            // $client = new Client();
            // $url = 'https://control.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/?content_type=text&integrated_number=917605926564&recipient_number='.$to.'&text="bmc"';
            // $response = $client->request('POST',$url , [
            //     'headers' => [
            //       'accept' => 'application/json',
            //       'authkey' => '233158AfWDBTKZ65b28419P1',
            //       'content-type' => 'application/json',
            //     ],
            //   ]);

            //   if($response->getStatusCode() == 200)
            //   {
                  
            //   }else{
            //       return [
            //           'success'=>false,
            //           'message' => "Something Went Wrong",
            //       ];
            //   }
        } catch (Exception $e) {
            Log::error('error sending email Exception: ' . $e->getMessage());
            return [
                'success'=>false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
