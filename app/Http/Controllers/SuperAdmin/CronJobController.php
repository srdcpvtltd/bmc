<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Shop;
use Illuminate\Http\Request;

class CronJobController extends Controller
{
    public function monthlyPayments()
    {
        return view('super_admin.cronjob.create-monthly-payments');
    }
    public function createMonthlyPayments(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $shops = Shop::all();
        foreach($shops as $shop)
        {
            if(Payment::where('month',$month)->where('shop_id',$shop->id)->where('year',$year)->count() == 0)
            {
                $amount = $shop->establishment_shop ? $shop->establishment_shop->shop_rent : $shop->shop_rent;
                $amount = (float) $amount;
                Payment::create([
                    'month' => $month,
                    'shop_id' => $shop->id,
                    'year' => $year,
                    'user_id' => $shop->user_id ?? null,
                    'type' => 'monthly',
                    'location' => $shop->lat_long,
                    'name' => $shop->owner_name,
                    'owner_name' => $shop->owner_name,
                    'shop_name' => $shop->shop_name,
                    'phone' => $shop->phone,
                    'email' => $shop->email,
                    'is_paid' => 0,
                    'establishment_shop_id' => $shop->establishment_shop ? $shop->establishment_shop->id : $shop->establishment_shop_id,
                    'establishment_id' => $shop->establishment_shop ? $shop->establishment_shop->establishment_id  : $shop->establishment_id,
                    'amount' => number_format($amount, 2),
                    'shop_rent' => $shop->establishment_shop ? $shop->establishment_shop->shop_rent : $shop->shop_rent,
                    'shop_size' => $shop->establishment_shop ? $shop->establishment_shop->shop_size : $shop->shop_size,
                    'shop_type' => $shop->establishment_shop ? $shop->establishment_shop->shop_type : $shop->shop_type,
                    'shop_number' => $shop->establishment_shop ? $shop->establishment_shop->shop_number : $shop->shop_number,
                ]);
            }
        }
        toastr()->success('Payment Created Successfully');
        return redirect()->back();
    }
}
