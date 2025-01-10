<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'client_name',
        'quantity',
        'total_price',
        'order_date',
    ];

    /**
     * Relation avec le modèle Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
