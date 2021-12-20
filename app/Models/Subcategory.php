<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
