<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis via un formulaire.
     */
    protected $fillable = [
        'name',
        'icon',
        'type_id',
    ];

    /**
     * Relation avec le modèle TypeFilter.
     * Un filtre appartient à un type.
     */
    public function type()
    {
        return $this->belongsTo(TypeFilter::class);
    }
}
