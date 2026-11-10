<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:100|unique:categories,nom',
            'description' => 'nullable|string',
            'titre' => 'required|string|min:10|max:200|unique:publications,titre',
            ];
    }
}