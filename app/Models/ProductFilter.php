<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;

    protected $table = 'productfilter'; // Nom de la table

    public $timestamps = false;

    // Colonnes autorisées pour la mise à jour en masse (mass assignment)
    protected $fillable = [
        'product_id',
        'filter_id',
    ];

    // Relation avec le produit (Product)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relation avec le filtre (Filter)
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id');
    }
}
