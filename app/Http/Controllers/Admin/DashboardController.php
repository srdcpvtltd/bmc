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
        $month_wise_paid_payments= [];
        $month_wise_name= [];
        $daily_collection_dates= [];
        $last_15_days_daily_collection= [];
        if($request->has('year'))
            $year = $request->year;
        else 
            $year = Carbon::now()->format('Y');
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
        $year_text = "Monthly Payments for ".$year;
        for($i = 1;$i<=12;$i++)
        {
            $month = date("F", mktime(0, 0, 0, $i, 1));
            $month_wise_paid_payment = Payment::where('month',$month)
                                        ->where('is_paid',1)
                                        ->where('type','monthly')
                                        ->where('year',$year)
                                        ->sum('amount');
            array_push($month_wise_name,$month);
            array_push($month_wise_paid_payments,$month_wise_paid_payment);
        }
        for($j= 15;$j > 0;$j--)
        {
            $collectionDate= Carbon::now()->subDays($j);
            $dailyCollectionData  = Payment::query()
            ->where('type','daily')
            ->whereDate('created_at',$collectionDate)
            ->sum('amount');
            array_push($daily_collection_dates,$collectionDate->format('d M'));
            array_push($last_15_days_daily_collection,$dailyCollectionData);
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
            $month = $request->month;
        }else{
            $month_text = 'Period Billing '.Carbon::now()->format('F');
            $month = Carbon::now()->format('F');
            $total_payments = Payment::where('month',Carbon::now()->format('F'))->where('type','monthly')->sum('amount');
            $paid_amount = Payment::where('month',Carbon::now()->format('F'))->where('is_paid',1)->where('type','monthly')->sum('amount');
            $pending_amount = Payment::where('month',Carbon::now()->format('F'))->where('is_paid',0)->where('type','monthly')->sum('amount');
            array_push($payments_of_month,$total_payments);
            array_push($payments_of_month,$paid_amount);
            array_push($payments_of_month,$pending_amount);
        }
        $totalBilledAmountText = "Total Billed Amount : ".$total_payments;
        $totalCollectedAmountText = "Total Collected Amount : ".$paid_amount;
        $data['daily_collection_dates']      = "'".implode("', '", $daily_collection_dates)."'";
        $data['last_15_days_daily_collection']    = implode(', ', $last_15_days_daily_collection);
        $data['payments_for_month']    = implode(', ', $paymentsDataForMonth);
        $data['payments_for_current_date']    = implode(', ', $paymentsDataForCurrentDate);
        $data['total_payments']      = $total_payments;
        $data['paid_amount']      = $paid_amount;
        $data['labels']      = "'".implode("', '", $labelsArray)."'";
        $data['payments_of_month']      = "'".implode("', '", $payments_of_month)."'";
        $data['paymentsDataForLastTwoDays']      = "'".implode("', '", $paymentsDataForLastTwoDays)."'";
        $data['month_wise_name']      = "'".implode("', '", $month_wise_name)."'";
        $data['month_wise_paid_payments']      = "'".implode("', '", $month_wise_paid_payments)."'";
        return view('admin.dashboard.index',compact('data','month_text','month','year','year_text','totalBilledAmountText','totalCollectedAmountText'));
    }
}
