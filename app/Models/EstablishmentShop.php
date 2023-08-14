<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstablishmentShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_number','shop_type','shop_size','shop_rent','establishment_id','status'
    ];
}
