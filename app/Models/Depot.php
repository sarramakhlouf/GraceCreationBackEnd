<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;

class Depot extends Model
{
    /** @use HasFactory<\Database\Factories\DepotFactory> */
    use HasFactory;

    public function Inventories(){
        return $this->hasMany(Inventory::class);
    }
    protected $fillable = ['name'];
    
}
