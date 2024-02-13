<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $table = 'baskets';

    protected $fillable = [
        'user_id',
        'guest_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }


    public function items()
    {
        return $this->hasMany(BasketItem::class, 'basket_id');
    }
}
