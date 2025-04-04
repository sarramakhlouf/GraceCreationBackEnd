<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Product;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function SubCategories(){
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, SubCategory::class);
    }
}
