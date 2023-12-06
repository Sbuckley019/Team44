<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = ['name', 'description'];

    public function getAllCategories(){
        return $this->all();
    }

    public function createProductCategory(){
        return $this->create([])
    }
    $categories = ProductCategory::all();

    $newCategory = ProductCategory::create([
        'name' = $this->name,
        'description'=> $this->description
    ]);

    $category = ProductCategory::find(1);

}
