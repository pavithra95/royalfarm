<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function Productvariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

     

    public function unit()
    {
        return $this->belongsTo(Unit::class,'v_unit_id');
    } 
    public function Sunit(){
        return $this->belongsTo(Unit::class,'s_unit_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function Subcategory()
    {
        return $this->belongsTo(Category::class,'sub_category_id');
    }
//     public function cartItems()
// {
//     return $this->hasMany(CartItem::class);
// }

}
