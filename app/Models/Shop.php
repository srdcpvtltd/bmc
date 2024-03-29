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
    public function arrears()
    {
        return $this->hasMany(PendingPayment::class,'shop_id');
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
    public function getQRCode($height,$width)
    {
        $shopTax = ShopTax::where('establishment_id',$this->establishment_id)->first();
        $tax_amount = 0;
        $amount = $this->establishment_shop ? $this->establishment_shop->shop_rent : $this->shop_rent;
        if($shopTax)
        {
            if($shopTax->type == "Percentage")
            {
                $tax_amount = $amount/100 * $shopTax->amount;
            }else{
                $tax_amount = $shopTax->amount;
            }
        }
        $amount = $amount + $tax_amount;
        return "https://chart.googleapis.com/chart?cht=qr&chs=".$height."x".$width."&chl={'establishment_id':'"
        .$this->establishment_id."','establishment_name':'".@$this->establishment->name."','shop_id':'".@$this->id.
        "','establishment_shop_id':'".@$this->establishment_shop_id."','shop_number':'".$this->shop_number.",'tax_amount':'".$tax_amount.",'amount':'".$amount."'}";
    }
}
