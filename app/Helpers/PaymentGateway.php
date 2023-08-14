<?php

namespace App\Helpers;

use App\Models\QrCode;
use App\Models\QrCodePayment;
use Carbon\Carbon;
use Razorpay\Api\Api;

class PaymentGateway
{
    public static function proccess($request)
    {
        $key_id = 'rzp_live_NUDgAouS6X8GKk';
        $secret = 'zrylqxgKWdLWO9X2zSDvR1ZU';
        $api = new Api($key_id, $secret);
        $data = [
            'type' => 'upi_qr',
            'name' => $request->name,
            'usage' => $request->usage,
            'fixed_amount' => $request->fixed_amount?1:0,
            'payment_amount' => $request->payment_amount * 100,
            'customer_id' => $request->customer_id,
            'description' => $request->description,
            // 'close_by' => '1681615838',
            'notes' => [
                'purpose' => $request->notes,
            ],
        ];
        $qrCode = $api->qrCode->create($data);
        if($qrCode && $qrCode->name)
        {
            QrCode::create([
                'name' => $request->name,
                'usage' => $request->usage,
                'fixed_amount' => $request->fixed_amount?1:0,
                'payment_amount' => $request->payment_amount,
                'shop_id' => $request->shop_id,
                'customer_id' => $request->customer_id,
                'description' => $request->description,
                'notes' => $request->notes,
                'status' => $qrCode->status,
                'image_url' => $qrCode->image_url,
                'qr_id' => $qrCode->id,
            ]);

        }
    } 
    public static function createCustomer($shop)
    {
        $key_id = 'rzp_live_NUDgAouS6X8GKk';
        $secret = 'zrylqxgKWdLWO9X2zSDvR1ZU';
        $api = new Api($key_id, $secret);
        $data = [
            'name' => $shop->owner_name,
            'email' => $shop->email,
            'contact' => $shop->phone,
            'notes' => [
                'notes_key_1' => 'Shop Size : '.$shop->shop_size,
                'notes_key_2' => 'Shop Rent : '.$shop->shop_rent,
            ],
        ];
        $customer = $api->customer->create($data);
        if($customer && $customer->id)
        {
            $shop->update([
                'customer_id' => $customer->id
            ]);
        }
    } 
    public static function storePayments()
    {
        $key_id = 'rzp_live_NUDgAouS6X8GKk';
        $secret = 'zrylqxgKWdLWO9X2zSDvR1ZU';
        $api = new Api($key_id, $secret);
        $qrCodes = QrCode::all();
        $options = [];
        foreach($qrCodes as $qrCode)
        {
            $payments = $api->qrCode->fetch($qrCode->qr_id)->fetchAllPayments($options)->items;
            foreach($payments as $payment)
            {
                $alreadyExist = QrCodePayment::where('payment_id',$payment->id)->first();
                if(!$alreadyExist)
                {
                    QrCodePayment::create([
                        'amount' => $payment->amount /100,
                        'status' => $payment->status,
                        'customer_id' => $payment->customer_id,
                        'payment_id' => $payment->id,
                        'payment_created_at' => Carbon::parse($payment->created_at),
                        'qr_code_id' => $qrCode->id
                    ]);
                }else{
                    $alreadyExist->update([
                        'amount' => $payment->amount /100,
                        'status' => $payment->status,
                        'customer_id' => $payment->customer_id,
                        'payment_id' => $payment->id,
                        'payment_created_at' => Carbon::parse($payment->created_at),
                        'qr_code_id' => $qrCode->id
                    ]);
                }
            }
        }
    } 
}
