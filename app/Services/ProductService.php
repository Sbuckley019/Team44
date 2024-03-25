<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductService
{
    public function getProducts($filters = null, $userId = null, $isFavourites = false, $limit = null)
    {
        $query = Product::query();

        if ($limit) {
            $query->limit($limit);
        }

        if (isset($filters['searchTerm'])) {
            $query->where('product_name', 'LIKE', '%' . $filters['searchTerm'] . '%');
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['category'])) {
            $category_id = ProductCategory::where('category_name', $filters['category'])->pluck('id');
            $query->where('category_id', $category_id);
        }

        if (isset($filters['rating'])) {
            $query->where('rating', '>=', $filters['rating']);
        }

        if (isset($filters['minPrice'])) {
            $query->where('price', '<=', $filters['maxPrice']);
            $query->where('price', '>=', $filters['minPrice']);
        }

        if ($isFavourites) {
            $query->whereHas('favourites', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        if (isset($filters['sort'])) {
            switch ($filters['sort']) {
                case 'HTL':
                    $query->orderBy('price', 'desc');
                    break;
                case 'LTH':
                    $query->orderBy('price', 'asc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    break;
            }
        }

        $products = $query->get()->map(function ($product) use ($userId) {
            $product->isFavourite = $product->favourites->contains('user_id', $userId);
            unset($product->favourites);
            return $product;
        });

        return $products;
    }

    public function getProduct($product_name)
    {
        $userId = auth()->check();

        $product = Product::where('product_name', $product_name)->first();

        $product->isFavourite = $product->favourites->contains('user_id', $userId);

        return $product;
    }

    public function findProductById($productId)
    {
        $product = Product::where('id', $productId)->first();

        return $product;
    }

    public function checkAvailability($productId, $quantity)
    {
        $product = Product::where('id', $productId)->first();

        $stock = $product->stock_quantity;

        return $quantity <= $stock;
    }
}
