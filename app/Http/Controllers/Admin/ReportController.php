<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\Shop;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function shopReports(Request $request)
    {
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
        return view('admin.reports.shop-report',compact('shops'));
    }
    public function establismentReports(Request $request)
    {
        $establisments = Establishment::all();
        return view('admin.reports.establisment-report',compact('establisments'));
    }
}
