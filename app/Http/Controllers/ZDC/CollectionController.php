<?php

namespace App\Http\Controllers\ZDC;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\EstablishmentShop;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function getDailyCollection(Request $request)
    {
        $query = DB::table('users')
            ->join('payments', 'users.id', '=', 'payments.user_id')
            ->selectRaw('users.id, users.name, 
                         SUM(CASE WHEN payments.payment_mode = "Cash" THEN payments.amount ELSE 0 END) as cash_amount,
                         SUM(CASE WHEN payments.payment_mode = "UPI" THEN payments.amount ELSE 0 END) as upi_amount')
            ->where('payments.type', 'daily')
            ->where('users.role_id', 5)
            ->where('users.zone_id', Auth::user()->zone_id);
        
        if($request->date) {
            $query->whereDate('payments.created_at', Carbon::parse($request->date));
        }
        $users = $query->groupBy('users.id', 'users.name')->get();
        return view('zdc.collection.daily',compact('users'));
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
            $query->where('payments.month',$request->month);
        }else{
            $query->where('payments.month',Carbon::now()->format('F'));
        }
        $establishments = $query->groupBy('establishments.id','establishments.name')->get();
        return view('zdc.collection.monthly',compact('establishments'));
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
        return view('zdc.collection.monthly_by_zones',compact('month','year'));
    }

    public function getMonthlyCollectionDetail(Request $request,$id)
    {
        $establishment = Establishment::find($id);
        $query = Payment::query()->select('payments.*','users.name as user_name')
                        ->join('users','users.id','payments.user_id')
                        ->where('payments.type','monthly')
                        ->where('payments.is_paid',1)
                        ->where('payments.establishment_id',$id)
                        ->where('users.role_id', 5)
                        ->where('users.zone_id', Auth::user()->zone_id);
        if($request->month)
            $query->where('month',$request->month);
        $payments = $query->get();
        return view('zdc.collection.monthly_detail',compact('payments','establishment'));
    }
}
