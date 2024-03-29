<?php

namespace App\Http\Controllers\CollectionStaff;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\BillDeskService;
use App\Services\SmsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('collection_staff.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('collection_staff.payment.create');
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
            if($request->payment_mode == "UPI")
            {
                $request->merge([
                    'is_paid' => 0
                ]);
            }else{
                $request->merge([
                    'is_paid' => 1
                ]);
            }
            $payment = Payment::create($request->all());
            if($payment->is_paid)
            {
                $phone = $payment->phone ? $payment->phone : @$payment->shop->phone;
                if($phone && strlen($phone) == 10)
                {
                    (new SmsService())->sendSMS($phone);
                    (new SmsService())->sendWhatsappSMS($phone,$payment);
                }else{
                    Log::info("Sms Service phone number have issue : ".$phone);
                }
            }
            if($payment->payment_mode == "UPI")
            {
                return redirect()->to(route('collection_staff.payment.show',$payment->id));
            }
            toastr()->success('Payment Added Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);
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
            $url = url('success');
            return view('collection_staff.payment.show',compact('authorization_token','order_id','url'));
        }else{
            toastr()->error($response['error']);
            return redirect()->to(route('collection_staff.payment.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('collection_staff.payment.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $payment = Payment::find($id);
        if($request->payment_mode == "UPI")
        {
            $request->merge([
                'is_paid' => 0
            ]);
        }
        $payment->update($request->all());
        if($payment->is_paid)
        {
            $phone = $payment->phone ? $payment->phone : @$payment->shop->phone;
            if($phone && strlen($phone) == 10)
            {
                (new SmsService())->sendSMS($phone);
                (new SmsService())->sendWhatsappSMS($phone,$payment);
            }else{
                Log::info("Sms Service phone number have issue : ".$phone);
            }
        }
        if($payment->payment_mode == "UPI")
        {
            return redirect()->to(route('collection_staff.payment.show',$payment->id));
        }
        toastr()->success('Payment Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        toastr()->success('Payment Deleted successfully');
        return redirect()->back();
    }
}
