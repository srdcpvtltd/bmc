<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $zones  = Zone::all();
        $labelsArray= [];
        $paymentsDataForMonth= [];
        $paymentsDataForCurrentDate= [];
        foreach($zones as $zone)
        {
            $label = $zone->name;
            array_push($labelsArray, $label);
            $amount = Payment::query()->select('payments.*')
                    ->join('users','users.id','payments.user_id')
                    ->where('users.zone_id',$zone->id)->whereBetween('payments.created_at',[Carbon::now()->startOfMonth(),Carbon::now()])->sum('amount');
            array_push($paymentsDataForMonth, $amount);
            $day_amount = Payment::query()->select('payments.*')
                    ->join('users','users.id','payments.user_id')
                    ->where('users.zone_id',$zone->id)->whereDate('payments.created_at',Carbon::today())->sum('amount');
            array_push($paymentsDataForCurrentDate, $day_amount);
        }
        $data['payments_for_month']    = implode(', ', $paymentsDataForMonth);
        $data['payments_for_current_date']    = implode(', ', $paymentsDataForCurrentDate);
        $data['labels']      = "'".implode("', '", $labelsArray)."'";
        return view('super_admin.dashboard.index',compact('data'));
    }
}
