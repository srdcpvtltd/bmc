<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $creds = [
            'email' => $request->email,
            'password' => $request->password
        ];
        //Checking User Registeration Code Start
        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            toastr()->error('User is Not Registered.');
            return redirect()->back();
        }
        //Checking User Registeration Code End
        //User Authentication Code Start
        if(Auth::guard('user')->attempt($creds))
        {
            if($user->role->name == 'Admin')
            {
                toastr()->success('You Login Successfully');
                return redirect()->intended(route('admin.dashboard.index'));
            }else if($user->role->name == 'Collection Staff')
            {
                toastr()->success('You Login Successfully');
                return redirect()->intended(route('collection_staff.dashboard.index'));
            }
            else if($user->role->name=='ZDC')
            {
                return redirect()->intended(route('zdc.dashboard.index'));
                toastr()->success('You Login Successfully');

            }
            else if($user->role->name=='Super Admin')
            {
                return redirect()->intended(route('super_admin.dashboard.index'));
                toastr()->success('You Login Successfully');

            }
            else{
                Auth::logout();
                toastr()->error('User is In Active or Not Verified Yet By Admin.');
                return redirect()->back();
            }
        } else {
            toastr()->error('Wrong Password.');
            return redirect()->back();
        }
        //User Authentication Code End
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        toastr()->success('You Logout Successfully');
        return redirect('/');
    }
    public function register(Request $request)
    {
        try{
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required',
                'image' => 'required',
                'password' => 'required',
                'role_id' => 'required',
            ]);
            if($request->password != $request->confirm_password)
            {
                toastr()->error('Password do not match');
                return redirect()->back();
            }
            $validator = Validator::make($request->all(),[
                'email' => 'required|unique:users'
            ]);
            if($validator->fails()){
                toastr()->error('Email already exists');
                return redirect()->back();
            }
            $user = User::create($request->all());
            toastr()->success('Your Account Has Been successfully Created, Please Login and See Next Step Guides.');
            return redirect(url('/'));
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return back();
        }

    }
    public function payment_back(Request $request)
    {
        dd($request);
    }
    public function paymentTesting()
    {
        $headers = ["alg" => "HS256", "clientid" => 'bmcorpuat', 'typ' => 'JWT'];

        $dateTime = Carbon::now()->setTimezone('Asia/Kolkata');
        $formattedDateTime = $dateTime->format('Y-m-d\TH:i:sP');

        $orderDate = $formattedDateTime;
        $amount = 1;
        $payload = [
            "mercid" => 'BMCORPUAT',
            "orderid" => rand(1111, 9999),
            "amount" => $amount,
            "order_date" => $orderDate,
            "currency" => "356",
            "ru" => url('payment_back'),
            "additional_info" => [
                "additional_info1" => 'q34324',
                "additional_info2" => 'dsaasaasd',
            ],
            "itemcode" => "DIRECT",
            "device" => [
                "init_channel" => "internet",
                "ip" => request()->ip(),
                "accept_header" => "text/html",
                "user_agent" => "Windows 10",
            ]
        ];
        $header = base64_encode(json_encode($headers));
        $payload = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', "$header.$payload", 'Kr7mREYKcU9E0HExLpb1grnxVqsf9YfI', true);
        $signature = base64_encode($signature);
        $curl_payload = "$header.$payload.$signature";
        
        $ch = curl_init( 'https://uat1.billdesk.com/u2/payments/ve1_2/orders/create' );

        $tracid=rand(1111,9999);

        $ch_headers = array(
            "Content-Type: application/jose",
            "accept: application/jose",
            "BD-Traceid:".$tracid,
            "BD-Timestamp: 20200817132207"
        );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $ch_headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $curl_payload);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        $launch_billdesk = false;
        try{ 
        //  $hashResult = hash_hmac('sha256', "$result", 'Kr7mREYKcU9E0HExLpb1grnxVqsf9YfI',true);
        //  $result_decoded = base64_decode($result);
         list(, $response,) = explode('.', $result);
         $result_decoded = base64_decode(strtr($response, '-_', '+/'));

            $result_array =json_decode($result_decoded, true);

            if($result_array['status'] == "ACTIVE") {
                $bdorderid= $result_array['bdorderid'];
                $autharray= $result_array['links'][1];

                

                $headersArray= $autharray['headers'];
                $authorization_token=$headersArray['authorization'];
                
                $data['authorization_token']= $authorization_token;
                $data['bdorderid']= $bdorderid;
                // lauching billdesk payment page
                return view("test.payment",compact('data'));

               
            } else { // Response error
                echo "Response error";
            }
                            
        } catch (\Exception $e) {
          echo $e;
        }
        // $encodedPayload = Crypt::encrypt(json_encode($payload));

        // $tracid = rand(1111, 9999);
        // $chHeaders = [
        //     "Content-Type: application/jose",
        //     "accept: application/jose",
        //     "BD-Traceid:" . $tracid,
        //     "BD-Timestamp: 20200817132207",
        //     "alg: HS256", 
        //     "clientid: bmcorpuat",
        // ];

        // $response = Http::withHeaders($chHeaders)
        //     ->post('https://api.billdesk.com/payments/ve1_2/orders/create', [
        //         'payload' => $encodedPayload
        //     ]);
        // dd($response->json());
        // $decodedResponse = json_decode(Crypt::decrypt($response), true);
        // dd($decodedResponse);
        // if ($decodedResponse['status'] == 'ACTIVE') {
        //     $bdOrderId = $decodedResponse['bdorderid'];
        //     $authArray = $decodedResponse['links'][1];
        //     $headersArray = $authArray['headers'];
        //     $authorizationToken = $headersArray['authorization'];

        //     $data['authorization_token'] = $authorizationToken;
        //     $data['bdorderid'] = $bdOrderId;
        //     return view("test.payment",compact('data'));
        // } else {
        //     // Response error
        //     echo "Response error";
        // }
    }

}
