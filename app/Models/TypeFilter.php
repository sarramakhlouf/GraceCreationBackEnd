<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Filter;

class TypeFilter extends Model
{
    use HasFactory;

    protected $table = 'typefilter';

    public $timestamps = false;
    
    protected $fillable = ['type'];

    public function filters()
    {
        return $this->hasMany(Filter::class, 'type_id');
    }
}
