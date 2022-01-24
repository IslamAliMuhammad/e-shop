<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_session_id',
        'variation_id',
        'qty'
    ];

    public function shoppingSession()
    {
        return $this->belongsTo(ShoppingSessions::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
