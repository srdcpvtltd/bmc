<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\Shop;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReportController extends Controller
{

public function zoneReports(Request $request)
{
    $zones=Zone::all();

    return view('super_admin.reports.zone-reports',compact('zones'));
}

public function zoneEstablishment($id)
{
   $establisments= Establishment::where('establishment_zone_id',Crypt::decrypt($id))->get();
   return view('super_admin.reports.zone-establisment',compact('establisments'));
}

public function zoneEstablishmentShopReports($id)
{

   $shops= Shop::where('establishment_id',Crypt::decrypt($id))->get();
   return view('super_admin.reports.shop-report',compact('shops'));
}

    public function shopReports(Request $request)
    {



          dd('dsds');
        $query = Shop::query();
        if($request->zone_id)
            $query->where('zone_id',$request->zone_id);
        if($request->ward_id)
            $query->where('ward_id',$request->ward_id);
        if($request->establishment_id)
            $query->where('establishment_id',$request->establishment_id);
        if($request->shop_name)
            $query->where('shop_name','LIKE','%'.$request->shop_name.'%');
        $shops = $query->get();
        return view('super_admin.reports.shop-report',compact('shops'));
    }
    public function establismentReports(Request $request)
    {
        $establisments = Establishment::all();
        return view('super_admin.reports.establisment-report',compact('establisments'));
    }
}
