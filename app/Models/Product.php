<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    
    public function SubCategories(){
        return $this->belongsTo(SubCategory::class);
    }

    public function packProducts()
    {
        return $this->hasMany(Product::class, 'pack_id', 'id');
    }

    protected $fillable = [
        'name', 'description', 'price', 'promotion', 'promo_price', 
        'available', 'image', 'subcategory_id','pack', 'pack_id',
    ];
    

}
