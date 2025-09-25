<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
     public function items()
    {
    return $this->hasMany(VariantDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variantDetails()
    {
        return $this->hasMany(VariantDetail::class, 'variant_id');
    }

    public function variationDetails()
    {
        return $this->hasMany(VariantDetail::class);
    }
}
