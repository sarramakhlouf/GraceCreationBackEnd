<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Depot;
use App\Models\Product;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;

    protected $fillable = [
        'quantite', 'product_id', 'depot_id'
    ];

    public function depot(){
        return $this->belongsTo(Depot::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
