<?php

namespace App\Models;

use App\Models\Wishlist;
use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, Translatable, CascadeSoftDeletes, InteractsWithMedia, Searchable;

    public $translatedAttributes = ['name', 'description'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $cascadeDeletes = ['variations'];

    public function getPrice()
    {
        return number_format($this->price, 2);
    }

    public function getTotalPrice($qty)
    {
        $total = $this->price * $qty;

        return $total;

    }

    public function getVariation($colorId, $sizeId) {
        return $this->variations()->where('color_id', $colorId)->where('size_id', $sizeId)->firstOrFail();
    }

    public function scopeNewness($query)
    {
        return $query->latest();
    }

    public function scopePriceLowToHigh($query)
    {
        return $query->orderBy('price', 'asc');
    }

    public function scopePriceHighToLow($query)
    {
        return $query->orderBy('price', 'desc');
    }

    public function scopePrice($query, $min, $max)
    {

        return $query->where('price', '>=', $min)->when($max, function ($query) use ($max){
            return $query->where('price', '<=', $max);
        });
    }

    public function scopeColor($query, $colorId)
    {

        return $query->with(['variations' => function ($query) use ($colorId) {
            return $query->where('color_id', $colorId);
        }]);
    }

    public function scopeCategory($query, $categoryId)
    {

    }


    public function variations() {
        return $this->hasMany(Variation::class);
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

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function wishlists() {
        return $this->hasMany(Wishlist::class);
    }

}
