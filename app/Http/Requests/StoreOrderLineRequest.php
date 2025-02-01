<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderLineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules()
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ];
    }

    /**
     * Messages d'erreur personnalisés (facultatif).
     */

    public function messages()
    {
        return [
            'order_id.required' => 'L\'ID de la commande est requis.',
            'product_id.required' => 'L\'ID du produit est requis.',
            'quantity.required' => 'La quantité est requise.',
            'price.required' => 'Le prix est requis.',
        ];
    }
}
