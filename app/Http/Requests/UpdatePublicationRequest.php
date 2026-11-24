<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePublicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => [
                'required',
                'string',
                'min:10',
                'max:200',
                Rule::unique('publications', 'titre')
                    ->ignore($this->route('publication')),
            ],
            'contenu' => 'required|string|min:20',
            'categorie_id' => 'required|exists:categories,id',
        'image' => 'nullable|file|image|max:2048',
'fichier_media' => 'nullable|file|mimes:mp3,mp4,wav|max:20480',
            ];
    }
    public function messages(): array
{
    return [
        'titre.min' => 'Le titre doit contenir au moins 10 caractères.',
        'titre.unique' => 'Ce titre est déjà utilisé par une autre publication.',
        'contenu.min' => 'Le contenu doit contenir au moins 20 caractères.',
    ];
}
}