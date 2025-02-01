<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'order_date',
        'total',
    ];
    
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
