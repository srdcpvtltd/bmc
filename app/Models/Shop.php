<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'shop_name','owner_name','phone','email','shop_number','shop_rent','lat_long',
        'rent_frequency', 'zone_id', 'establishment_id','location_id','structure_id',
        'establishment_category_id','ward_id','shop_size','shop_type','id_proof','id_proof_number',
        'customer_id','location'
    ];
    public function qrCodes()
    {
        return $this->hasMany(QrCode::class,'shop_id');
    }
}
