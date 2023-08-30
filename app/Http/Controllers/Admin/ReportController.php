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
        $shops = Shop::all();
        return view('admin.reports.shop-report',compact('shops'));
    }
    public function establismentReports(Request $request)
    {
        $establisments = Establishment::all();
        return view('admin.reports.establisment-report',compact('establisments'));
    }
}
