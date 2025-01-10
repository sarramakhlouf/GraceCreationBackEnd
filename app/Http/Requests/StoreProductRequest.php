<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' => 'required|numeric',
            //'excl_tax_price' => 'required|numeric',
            'promotion' => 'required|boolean',
            'promo_price' => 'nullable|numeric|lt:price',
            //'excl_tax_pricePromo' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'available' => 'boolean',
            'pack' => 'boolean',
            'pack_id' =>'nullable|numeric',
        ];
    }
}
