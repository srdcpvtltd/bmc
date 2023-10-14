<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstablishmentShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_number','shop_type','shop_size','shop_rent','establishment_id','status','zone_id'
    ];
    public function shop()
    {
        return $this->hasOne(Shop::class,'establishment_shop_id');
    }
    public function establishment()
    {
        return $this->hasOne(Establishment::class,'establishment_id');
    }
}
