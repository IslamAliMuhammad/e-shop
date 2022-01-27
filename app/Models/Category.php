<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, Translatable, CascadeSoftDeletes;

    public $translatedAttributes = ['name'];
    protected $fillable = [];
    protected $cascadeDeletes = ['subcategories'];

    public function subcategories() {
<<<<<<< HEAD
        return $this->hasMany(SubCategory::class);
=======
        return $this->hasMany(Subcategory::class);
>>>>>>> dev
    }

}
