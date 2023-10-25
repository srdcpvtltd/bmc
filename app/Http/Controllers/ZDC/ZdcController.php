<?php

namespace App\Http\Controllers\ZDC;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\Payment;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ZdcController extends Controller
{

    public function index()
    {
        $user=Auth::user();
        $establishments  = Establishment::where('establishment_zone_id',$user->zone_id)->get();
        $labelsArray= [];
        $paymentsDataForMonth= [];
        $paymentsDataForCurrentDate= [];
        foreach($establishments as $establishment)
        {
            $label = $establishment->name;
            array_push($labelsArray, $label);
            $amount = Payment::query()->select('payments.*')
                    ->join('users','users.id','payments.user_id')
                    ->where('users.zone_id',$user->zone_id)
                    ->where('payments.establishment_id',$establishment->id)
                    ->where('payments.type','monthly')
                    ->where('payments.is_paid',1)
                    ->where('payments.month',Carbon::now()->format('F'))->sum('amount');
            array_push($paymentsDataForMonth, $amount);
        }
        $paymentsDataForCurrentDate = Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','daily')
                ->where('users.zone_id',$user->zone_id)
                ->whereDate('payments.created_at',Carbon::today())->sum('amount');
        $data['payments_for_month']    = implode(', ', $paymentsDataForMonth);
        $data['payments_for_current_date']    = $paymentsDataForCurrentDate;
        $data['labels']      = "'".implode("', '", $labelsArray)."'";
        $data['monthly_chart_title']      = 'Establishment Wise Payment Collection for Current Month  (Monthly Collection of '.@$user->zone->name.')';
        return view('zdc.dashboard.index',compact('user','data'));
    }

    public function ZoneEstablishmentReport($id)
    {
        $establisments= Establishment::where('establishment_zone_id',Crypt::decrypt($id))->get();
        return view('zdc.reports.zone-establishment',compact('establisments'));
    }

    public function zoneEstablishmentShopReports($id)
{

   $shops= Shop::where('establishment_id',Crypt::decrypt($id))->get();
   return view('zdc.reports.shop-report',compact('shops'));
}

public function establismentReports($id)
{
    $establisments = Establishment::where('establishment_zone_id',Crypt::decrypt($id))->get();
    return view('zdc.reports.establisment-report',compact('establisments'));
}


}
