<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|min:10|max:200|unique:publications,titre',
            'contenu' => 'required|string|min:10',
            'categorie_id' => 'required|exists:categories,id',
        ];
    }
    public function messages(): array
{
    return [
        'titre.min' => 'Le titre doit contenir au moins 10 caractères.',
        'titre.unique' => 'Ce titre existe déjà. Choisissez un autre titre.',
        'contenu.min' => 'Le contenu doit contenir au moins 10 caractères.',
    ];
}
}