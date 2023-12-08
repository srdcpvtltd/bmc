<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name','background_color','icon_name','image'];

    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveImage($value,'/uploaded_images/');
    }
    public function getCollection()
    {
        return User::query()->join('payments','payments.user_id','users.id')->where('zone_id',$this->id)->where('payments.type','daily')->sum('payments.amount');
    }
    public function getDailyCollectedAmount($date)
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','daily')
                ->whereDate('payments.created_at',$date)
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getDailyCashAmount($date)
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','daily')
                ->whereDate('payments.created_at',$date)
                ->where('payments.payment_mode','Cash')
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getDailyUpiAmount($date)
    {
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','daily')
                ->whereDate('payments.created_at',$date)
                ->where('payments.payment_mode','UPI')
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyCollectedAmount($month = null,$year = null)
    {
        if(!$month)
            $month = Carbon::today()->format('F');
        if(!$year)
            $year = Carbon::today()->format('Y');
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.is_paid',1)
                ->where('payments.month',$month)
                ->where('payments.year',$year)
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyBilledAmount($month = null,$year = null)
    {
        if(!$month)
            $month = Carbon::today()->format('F');
        if(!$year)
            $year = Carbon::today()->format('Y');
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.month',$month)
                ->where('payments.year',$year)
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyCashAmount($month = null,$year = null)
    {
        if(!$month)
            $month = Carbon::today()->format('F');
        if(!$year)
            $year = Carbon::today()->format('Y');
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.payment_mode','Cash')
                ->where('payments.is_paid',1)
                ->where('payments.month',$month)
                ->where('users.zone_id',$this->id)->sum('amount');
    }
    public function getMonthlyUpiAmount($month = null,$year = null)
    {
        if(!$month)
            $month = Carbon::today()->format('F');
        if(!$year)
            $year = Carbon::today()->format('Y');
        return Payment::query()->select('payments.*')
                ->join('users','users.id','payments.user_id')
                ->where('payments.type','monthly')
                ->where('payments.payment_mode','UPI')
                ->where('payments.is_paid',1)
                ->where('payments.month',$month)
                ->where('payments.year',$year)
                ->where('users.zone_id',$this->id)->sum('amount');
    }

    public function estableshment()
    {
        return $this->hasMany(Establishment::class);
    }
}
