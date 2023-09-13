<?php

namespace App\Http\Controllers\ZDC;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ZdcController extends Controller
{

    public function index()
    {
            $user=Auth::user();
            return view('zdc.dashboard.index',compact('user'));
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
