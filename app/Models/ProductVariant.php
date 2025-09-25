<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'weight',
        'price',
        'discount_price',
        'image',
        'status',
        'sku',
        'v_stock',
        'tax_name',
        'tax_type',
        'total_selling_price',
    ];

    public function PvariantDetails()
    {
        return $this->hasMany(ProductVariantItem::class, 'attribute_id');
    }
    public function PvariantItems()
    {
        return $this->hasMany(ProductVariantItem::class, 'variation_id');
    }

   

//     public function cartItems()
// {
//     return $this->hasMany(CartItem::class);
// }

    
}
