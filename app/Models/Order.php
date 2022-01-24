<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'address_id',
        'created_at'
    ];

    public function getTotalPrice()
    {
        return number_format($this->total, 2);
    }


    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
