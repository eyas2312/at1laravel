@extends('layouts.app')

@section('titre', 'Modifier une catégorie')

@section('contenu')

    <h1>Modifier la catégorie</h1>

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
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description">{{ old('description', $category->description) }}</textarea>
        </div>

        <button type="submit">Enregistrer les modifications</button>

    </form>

    <a href="{{ route('categories.index') }}">Retour aux catégories</a>

@endsection