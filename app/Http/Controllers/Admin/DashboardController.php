<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $zones  = Zone::all();
        $labelsArray= [];
        $paymentsDataForMonth= [];
        $paymentsDataForCurrentDate= [];
        $paymentsDataForLastTwoDays= [];
        $payments_of_month= [];
        foreach($zones as $zone)
        {
            $label = $zone->name;
            array_push($labelsArray, $label);
            $amount = Payment::query()->select('payments.*')
                    ->join('users','users.id','payments.user_id')
                    ->where('payments.type','monthly')
                    ->where('payments.is_paid',1)
                    ->where('payments.month',Carbon::now()->format('F'))
                    ->where('users.zone_id',$zone->id)->sum('amount');
            array_push($paymentsDataForMonth, $amount);
            $day_amount = Payment::query()->select('payments.*')
                    ->join('users','users.id','payments.user_id')
                    ->where('payments.type','daily')
                    ->where('users.zone_id',$zone->id)->whereDate('payments.created_at',Carbon::today())->sum('amount');
            array_push($paymentsDataForCurrentDate, $day_amount);
            $last_two_daily_collection = Payment::query()->select('payments.*')
                    ->join('users','users.id','payments.user_id')
                    ->where('payments.type','daily')
                    ->where('users.zone_id',$zone->id)
                    ->whereBetween('payments.created_at', [
                        Carbon::yesterday()->startOfDay()->toDateTimeString(),
                        Carbon::today()->endOfDay()->toDateTimeString()
                    ])
                    ->sum('amount');
            array_push($paymentsDataForLastTwoDays, $last_two_daily_collection);

        }
        if($request->has('month'))
        {
            $month_text = 'Period Billing '.$request->month;
            $total_payments = Payment::where('month',$request->month)->where('type','monthly')->sum('amount');
            $paid_amount = Payment::where('month',$request->month)->where('is_paid',1)->where('type','monthly')->sum('amount');
            $pending_amount = Payment::where('month',$request->month)->where('is_paid',0)->where('type','monthly')->sum('amount');
            array_push($payments_of_month,$total_payments);
            array_push($payments_of_month,$paid_amount);
            array_push($payments_of_month,$pending_amount);
        }else{
            $month_text = 'Period Billing '.Carbon::now()->format('F');
            $total_payments = Payment::where('month',Carbon::now()->format('F'))->where('type','monthly')->sum('amount');
            $paid_amount = Payment::where('month',Carbon::now()->format('F'))->where('is_paid',1)->where('type','monthly')->sum('amount');
            $pending_amount = Payment::where('month',Carbon::now()->format('F'))->where('is_paid',0)->where('type','monthly')->sum('amount');
            array_push($payments_of_month,$total_payments);
            array_push($payments_of_month,$paid_amount);
            array_push($payments_of_month,$pending_amount);
        }
        $data['payments_for_month']    = implode(', ', $paymentsDataForMonth);
        $data['payments_for_current_date']    = implode(', ', $paymentsDataForCurrentDate);
        $data['labels']      = "'".implode("', '", $labelsArray)."'";
        $data['payments_of_month']      = "'".implode("', '", $payments_of_month)."'";
        $data['paymentsDataForLastTwoDays']      = "'".implode("', '", $paymentsDataForLastTwoDays)."'";
        return view('admin.dashboard.index',compact('data','month_text'));
    }
}
