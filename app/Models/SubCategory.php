<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // Définir explicitement le nom de la table
    protected $table = 'subcategories';  // Le nom correct de la table

    protected $fillable = [
        'name',
        'category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Products(){
        return $this->hasMany(Product::class);
    }
}



