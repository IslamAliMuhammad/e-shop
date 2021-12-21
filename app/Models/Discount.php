<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{

    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['discount_percent', 'is_active'];


    public function products() {
        return $this->hasMany(Product::class);
    }
}
