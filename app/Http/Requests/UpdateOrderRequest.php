<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true; // Autoriser toutes les requêtes pour l'instant.
    }

    /**
     * Règles de validation applicables à la requête.
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'client_name' => 'required|string|max:255',
            //'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'order_date' => 'required|date',
        ];
    }

    /**
     * Messages d'erreur personnalisés (facultatif).
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'Le produit est requis.',
            'client_name.required' => 'Le nom du client est requis.',
            //'quantity.required' => 'La quantité est obligatoire.',
            'total_price.required' => 'Le prix total est requis.',
            'order_date.required' => 'La date de commande est obligatoire.',
        ];
    }
}
