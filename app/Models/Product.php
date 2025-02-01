<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Inventory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'promotion', 'promo_price', 
        'available', 'image', 'subcategory_id','pack', 'pack_id',
    ];
    
    public function SubCategories(){
        return $this->belongsTo(SubCategory::class);
    }

    public function inventories(){
        return $this->HasMany(Inventory::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
    
    public function packProducts()
    {
        return $this->hasMany(Product::class, 'pack_id', 'id');
    }

    // Produit associé à un pack
    public function pack()
    {
        return $this->belongsTo(Produit::class, 'pack_id');
    }

    // Produits associés à un pack
    public function produitsAssocies()
    {
        return $this->hasMany(Produit::class, 'pack_id');
    }

}
