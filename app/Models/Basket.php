<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $table = 'baskets';

    protected $fillable = [
        'customer_id',
    ];

    // setting up relationships between tables
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function items()
    {
        return $this->hasMany(BasketItem::class, 'basket_id');
    }

    // calculate and get the total value of the basket
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
