<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['name','amount','location','establishment_id','user_id','payment_mode'];
    
    public function establishment()
    {
        return $this->belongsTo(Establishment::class,'establishment_id');
    }
}
