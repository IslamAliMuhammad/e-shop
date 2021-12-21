<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, Translatable, CascadeSoftDeletes;

    public $translatedAttributes = ['name', 'description'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $cascadeDeletes = ['productVariations'];

    public function productVariations() {
        return $this->hasMany(ProductVariation::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
