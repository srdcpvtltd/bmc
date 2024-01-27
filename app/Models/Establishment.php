<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = ['name','establishment_category_id','total_shops','establishment_zone_id','background_color','icon_name','image'];

    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveImage($value,'/uploaded_images/');
    }

    public function establishment_category()
    {
        return $this->belongsTo(EstablishmentCategory::class,'establishment_category_id');
    }
    public function shops()
    {
        return $this->hasMany(Shop::class,'establishment_id');
    }
    public function tax()
    {
        return $this->hasOne(ShopTax::class,'establishment_id');
    }
}
