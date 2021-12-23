<?php

namespace App\Models;

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
    use HasFactory, SoftDeletes, Translatable, CascadeSoftDeletes, InteractsWithMedia;

    public $translatedAttributes = ['name', 'description'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $cascadeDeletes = ['variations'];

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
}
