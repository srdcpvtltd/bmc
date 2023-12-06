<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Services\BillDeskService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $payments = Payment::select('payments.*')->with(
                'establishment_shop',
                'establishment',
                'user',
                )->where('user_id',Auth::user()->id)->get();

            return response([
                "payments" => $payments,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try{
            $this->validate($request,[
                'name' => 'required',
                'amount' => 'required',
                'location' => 'required',
                'type' => 'required',
                'payment_mode' => 'required',
                'user_id' => 'required',
            ]);
            $request->merge([
                'is_paid' => 1 
            ]);
            if($request->type == "monthly")
            {
                $payment = Payment::where('month',$request->month)->where('shop_id',$request->shop_id)->where('establishment_shop_id',$request->establishment_shop_id)->where('year',$request->year)->first();
                // $payment = Payment::create($request->all());
                if($payment)
                {
                    $payment->update($request->all());
                    return response([
                        "payment" => $payment,
                    ], 200);
                }
                else{
                    return response([
                        "error" => "Payment Not Found"
                    ], 302);
                }

            }else{
                $payment = Payment::create($request->all());
                return response([
                    "payment" => $payment,
                ], 200);
            }
        }catch (Exception $e)
        {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $this->validate($request,[
                'payment_id' => 'required',
                'is_paid' => 'required',
                'payment_mode' => 'required',
            ]);
            $payment = Payment::find($request->payment_id);
            $payment->update($request->except('payment_id'));
            return response([
                "payment" => $payment,
            ], 200);
        }catch (Exception $e)
        {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
    public function getPendingInvoice(Request $request)
    {
        try {
            $payments = Payment::where('shop_id',$request->shop_id)->where('type','monthly')->where('is_paid',0)->get();

            return response([
                "payments" => $payments,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function updateUPIPayment(Request $request)
    {
        try {
            $payment = Payment::find($request->payment_id);
            $billdeskService = new BillDeskService();
            $response = $billdeskService->createOrder($payment);
            if($response['success'] == true)
            {
                $authorization_token = $response['authorization_token'];
                $order_id = $response['order_id'];
                $original_order_id = $response['original_order_id'];
                $payment->update([
                    'order_id' => $original_order_id
                ]);
                $url = url('api/payment-success');
                return response([
                    "authorization_token" => $authorization_token,
                    "order_id" => $order_id,
                    "url" => $url,
                ], 200);
            }else{
                return response([
                    "error" => $response['error']
                ], 500);
            }
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function successResponse(Request $request)
    {
        try{
            if($request->transaction_response)
            {
                list(, $response,) = explode('.', $request->transaction_response);
                $result_decoded = base64_decode(strtr($response, '-_', '+/'));
                $result_array =json_decode($result_decoded, true);
                if($result_array['transaction_error_type'] == 'success')
                {
                    $payment = Payment::where('order_id',$result_array['orderid'])->first();
                    $payment->update([
                        'is_paid' => 1,
                        'transcation_id' => $result_array['transactionid'],
                        'payment_method' => $result_array['payment_method_type'],
                    ]);
                    // $user = User::find($payment->user_id);
                    return response([
                        "message" => "Your Payment Done Successfully!"
                    ], 200);
                }else{
                    return response([
                        "error" => $result_array['transaction_error_type']
                    ], 500);
                }
            }else{
                return response([
                    "error" => "Something Went Wrong"
                ], 500);
            }

        }catch(Exception $e)
        {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
