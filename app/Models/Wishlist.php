<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_session_id',
       'product_id'
    ];

    public function shoppingSession()
    {
        return $this->belongsTo(ShoppingSessions::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
