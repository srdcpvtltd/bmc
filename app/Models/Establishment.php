<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = ['name','establishment_category_id','total_shops','establishment_zone_id','background_color','icon_name'];

    public function establishment_category()
    {
        return $this->belongsTo(EstablishmentCategory::class,'establishment_category_id');
    }
    public function shops()
    {
        return $this->hasMany(Shop::class,'establishment_id');
    }
}
