<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function getCollection()
    {
        return User::query()->join('payments','payments.user_id','users.id')->where('zone_id',$this->id)->sum('payments.amount');
    }

    public function estableshment()
    {
        return $this->hasMany(Establishment::class);
    }
}
