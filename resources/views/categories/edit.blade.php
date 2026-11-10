@extends('layouts.app')

@section('titre', 'Modifier une catégorie')

@section('contenu')

    <h1>Modifier la catégorie</h1>
@if ($errors->any())
    <ul class="erreurs">
        @foreach ($errors->all() as $erreur)
            <li>{{ $erreur }}</li>
        @endforeach
    </ul>
@endif
    <form action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input
                type="text"
                id="nom"
                name="nom"
                value="{{ old('nom', $category->nom) }}"
                required
            >
            @error('nom')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description">{{ old('description', $category->description) }}</textarea>
        </div>

        <button type="submit">Enregistrer les modifications</button>

    </form>

    <a href="{{ route('categories.index') }}">Retour aux catégories</a>

@endsection