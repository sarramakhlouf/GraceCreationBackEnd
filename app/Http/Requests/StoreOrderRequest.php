<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'products' => 'required|array', // Validation comme tableau d'objets
            //'products.*.quantity' => 'required|integer|min:1', // Validation de la quantité
            'total' => 'required|numeric',
        ];
    }


    /**
     * Messages d'erreur personnalisés (facultatif).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du client est requis.',
            'email.required' => 'Email du client est requis.',
            'address.required' => 'Adresse est obligatoire.',
            'phone.required' => 'Le numéro du téléphone est requis.',
            'products.required' => 'Les produits sont obligatoires.',
        ];
    }
}
