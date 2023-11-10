<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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
}
