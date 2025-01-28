<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeFilter extends Model
{
    use HasFactory;

    protected $table = 'typefilter';

    public $timestamps = false;
    
    protected $fillable = ['type'];
}
