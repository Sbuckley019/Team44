<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if (File::exists(public_path($product->image_path))) {
                File::delete(public_path($product->image_path));
            }
        });
    }

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'category_id',
        'stock_quantity',
        'image_url',
        'rating',
        'favourite',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getImageUrlAttribute($value)
    {
        return asset($value);
    }

    public function basketItems()
    {
        return $this->hasMany(BasketItem::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourites::class);
    }
}
