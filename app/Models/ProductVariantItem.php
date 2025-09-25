<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    protected $fillable = [
        'variation_id',
        'attribute_id',
        'value',
        
    ];

    public function PvariantDetails()
    {
        return $this->hasMany(VariantDetail::class,'id', 'attribute_id');
    }

    public function variationDetail()
    {
        return $this->belongsTo(VariantDetail::class, 'attribute_id');
    }

   

   
}
