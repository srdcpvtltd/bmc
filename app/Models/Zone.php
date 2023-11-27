<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function getCollection()
    {
        return User::query()->join('payments','payments.user_id','users.id')->where('zone_id',$this->id)->where('payments.type','daily')->sum('payments.amount');
    }
    public function getMonthlyCollectedAmount()
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.is_paid',1)
                ->where('payments.month',Carbon::now()->format('F'))
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyBilledAmount()
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.month',Carbon::now()->format('F'))
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyCashAmount()
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.payment_mode','Cash')
                ->where('payments.is_paid',1)
                ->where('payments.month',Carbon::now()->format('F'))
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyUpiAmount()
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.payment_mode','UPI')
                ->where('payments.is_paid',1)
                ->where('payments.month',Carbon::now()->format('F'))
                ->where('users.zone_id',$this->id)->sum('amount');
    }

    public function estableshment()
    {
        return $this->hasMany(Establishment::class);
    }
}
