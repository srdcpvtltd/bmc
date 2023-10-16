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
        'customer_id','location','establishment_shop_id','allotment_date','number_of_years',
        'valid_upto','allotment_number','trade_license_number','user_id'
    ];
    public function qrCodes()
    {
        return $this->hasMany(QrCode::class,'shop_id');
    }
    public function establishment_shop()
    {
        return $this->belongsTo(EstablishmentShop::class,'establishment_shop_id');
    }
    public function establishment_category()
    {
        return $this->belongsTo(EstablishmentCategory::class,'establishment_category_id');
    }
    public function establishment()
    {
        return $this->belongsTo(Establishment::class,'establishment_id');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class,'ward_id');
    }
    public function structure()
    {
        return $this->belongsTo(Structure::class,'structure_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getQRCode()
    {
        return "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl={'shop_name'='".
        $this->shop_name."','establishment_id':'".$this->establishment_id."','establishment_name':'".
        @$this->establishment->name."','establishment_name':'".@$this->establishment->name.
        "','establishment_shop_id':'".@$this->establishment_shop_id."','establishment_shop_name':'".
        @$this->establishment_shop->name."','shop_id':'".$this->id."','owner_name':'".$this->owner_name.
        "','shop_number':'".$this->shop_number."','phone':'".$this->phone."','email':'".$this->email.
        "','shop_rent':'".$this->shop_rent."','shop_size':'".$this->shop_size."','shop_type':'".$this->shop_type."'}";
    }
}
