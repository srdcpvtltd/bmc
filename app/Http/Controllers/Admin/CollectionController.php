<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Zone;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function getDailyCollection()
    {
        return view('admin.collection.daily');
    }

    public function showDailyCollection($zone_id)
    {
        $zone = Zone::find($zone_id);
        $payments = Payment::query()->select('payments.*','users.name as user_name')
                        ->join('users','users.id','payments.user_id')
                        ->where('users.zone_id',$zone_id)->get();
        return view('admin.collection.show_daily',compact('payments','zone'));
    }
}
