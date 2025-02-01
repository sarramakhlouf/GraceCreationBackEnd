<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser tous les utilisateurs à faire cette requête
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'depot_id' => 'required|exists:depots,id',
            'quantite' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Le champ Produit est obligatoire.',
            'product_id.exists' => 'Le produit sélectionné est invalide.',
            'depot_id.required' => 'Le champ Dépôt est obligatoire.',
            'depot_id.exists' => 'Le dépôt sélectionné est invalide.',
            'quantite.required' => 'Le champ Quantité est obligatoire.',
            'quantite.integer' => 'La quantité doit être un entier.',
            'quantite.min' => 'La quantité ne peut pas être négative.',
        ];
    }
}