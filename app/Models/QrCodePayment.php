<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodePayment extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','amount','status','payment_id','qr_code_id'];
    
    public function qrCode()
    {
        return $this->belongsTo(QrCode::class,'qr_code_id');
    }
}
