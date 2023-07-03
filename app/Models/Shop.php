<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    
    protected $fillable = ['owner_name','phone','email','shop_number','shop_number','shop_rent','lat_long',
        'rent_frequency', 'zone_id', 'establishment_id','location_id','area_id','establishment_category_id'                      
    ];

}
