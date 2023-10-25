<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\QrCodePayment;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function getDailyCollection()
    {
        return view('super_admin.collection.daily');
    }

    public function getMonthlyCollection(Request $request)
    {
        if($request->start_date)
        {
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
        }else{
            $start_date = Carbon::now()->startOfMonth();
            $end_date = Carbon::today();
        } 
        
        $payments = Payment::query()->select('payments.*','users.name as user_name')
                        ->join('users','users.id','payments.user_id')
                        ->where('payments.type','monthly')->where('payments.is_paid',1)->get();
       
        // $payments = QrCodePayment::query()->select('qr_code_payments.*','qr_codes.name as qr_code')
        //                 ->join('qr_codes','qr_codes.id','qr_code_payments.qr_code_id')
        //                 ->whereBetween('qr_code_payments.payment_created_at',[$start_date,$end_date])->get();
        return view('super_admin.collection.monthly',compact('start_date','end_date','payments'));
    }

    public function showDailyCollection($zone_id)
    {
        $zone = Zone::find($zone_id);
        $payments = Payment::query()->select('payments.*','users.name as user_name')
                        ->join('users','users.id','payments.user_id')
                        ->where('users.zone_id',$zone_id)->where('payments.type','daily')->get();
        return view('super_admin.collection.show_daily',compact('payments','zone'));
    }
}
