<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\Payment;
use App\Models\QrCodePayment;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function getDailyCollection(Request $request)
    {
        if($request->date)
            $date = $request->date;
        else 
            $date = Carbon::today()->format('Y-m-d');
        return view('admin.collection.daily',compact('date'));
    }
    public function getDailyCollectionByZone($id,Request $request)
    {
        $query = DB::table('users')
        ->join('payments', 'users.id', '=', 'payments.user_id')
        ->selectRaw('users.id, users.name, 
                     SUM(CASE WHEN payments.payment_mode = "Cash" THEN payments.amount ELSE 0 END) as cash_amount,
                     SUM(CASE WHEN payments.payment_mode = "UPI" THEN payments.amount ELSE 0 END) as upi_amount')
        ->where('payments.type', 'daily')
        ->where('users.role_id', 5)
        ->where('users.zone_id', $id);
        if($request->date)
            $date = $request->date;
        else 
            $date = Carbon::today()->format('Y-m-d');
        $query->whereDate('payments.created_at', Carbon::parse($date));
        $users = $query->groupBy('users.id', 'users.name')->get();
        
        return view('admin.collection.daily_user',compact('date','users'));
    }
    public function showDailyCollection($id)
    {
        $user = User::find($id);
        $payments = Payment::query()->select('payments.*','users.name as user_name')
                        ->join('users','users.id','payments.user_id')
                        ->where('users.id',$id)->where('payments.type','daily')->get();
        return view('admin.collection.show_daily',compact('payments','user'));
    }
    public function getMonthlyCollection($id,Request $request)
    {
        $query = DB::table('establishments')
            ->join('payments', 'establishments.id', '=', 'payments.establishment_id')
            ->join('users','users.id','payments.user_id')
            ->selectRaw('establishments.id,establishments.name, SUM(payments.amount) as total_amount')
            ->where('payments.type', 'monthly')
            // ->where('users.role_id', 5)
            ->where('payments.is_paid',1)
            ->where('users.zone_id', $id);
        if($request->month)
        {
            $month = $request->month;
        }else{
            $month = Carbon::now()->format('F');
        }
        $query->where('payments.month',$month);
        if($request->year)
        {
            $query->where('payments.year',$request->year);
        }else{
            $query->where('payments.year',Carbon::now()->format('Y'));
        }
        $establishments = $query->groupBy('establishments.id','establishments.name')->get();
        return view('admin.collection.monthly',compact('establishments','month'));
    }

    
    public function getMonthlyByZones(Request $request)
    {
        if($request->month)
            $month = $request->month;
        else
            $month = Carbon::now()->format('F');
        if($request->year)
            $year = $request->year;
        else
            $year = Carbon::now()->format('Y');
        return view('admin.collection.monthly_by_zones',compact('month','year'));
    }
    public function getMonthlyCollectionDetail(Request $request,$id)
    {
        $establishment = Establishment::find($id);
        $query = Payment::query()->select('payments.*','users.name as user_name')
                        ->join('users','users.id','payments.user_id')
                        ->where('payments.type','monthly')
                        ->where('payments.is_paid',1)
                        ->where('payments.establishment_id',$id);
        if($request->month)
            $month = $request->month;
        else
            $month = Carbon::now()->format('F');
        $query->where('month',$month);
        if($request->year)
            $year = $request->year;
        else
            $year = Carbon::now()->format('Y');
        $query->where('year',$year);
        $payments = $query->get();
        return view('admin.collection.monthly_detail',compact('payments','establishment','month','year'));
    }
}
