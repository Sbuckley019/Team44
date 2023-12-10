<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteProduct extends Model
{
    use HasFactory;
    protected $table = 'favourite_products';

    protected $fillable = ['customer_id', 'product_id'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
