<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'shop_id',
        'establishment_id',
        'user_id',
    ];
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function establishment()
    {
        return $this->belongsTo(Establishment::class,'establishment_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
