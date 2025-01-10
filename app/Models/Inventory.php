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

    public function Depots(){
        return $this->belongsTo(Depot::class);
    }
    public function Products(){
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        'quantite', 'product_id', 'depot_id'
    ];
}
