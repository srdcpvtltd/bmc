<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'type',
        'establishment_id',
        'limit'
    ];
    
    public function establishment()
    {
        return $this->belongsTo(Establishment::class,'establishment_id');
    }
}
