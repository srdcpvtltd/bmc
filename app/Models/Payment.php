<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'location',
        'establishment_id',
        'user_id',
        'payment_mode',
        'type',
        'establishment_shop_id',
        'shop_id',
        'owner_name',
        'phone',
        'email',
        'shop_number',
        'shop_rent',
        'shop_size',
        'shop_type',
        'month',
        'year'
    ];
    
    public function establishment()
    {
        return $this->belongsTo(Establishment::class,'establishment_id');
    }
    public function establishment_shop()
    {
        return $this->belongsTo(EstablishmentShop::class,'establishment_shop_id');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }
}
