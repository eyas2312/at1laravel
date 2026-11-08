@extends('layouts.app')

@section('titre', 'Ajouter une catégorie')

@section('contenu')

    <h1>Ajouter une catégorie</h1>

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf

        <div>
            <label for="nom">Nom de la catégorie :</label>
            <input
                type="text"
                id="nom"
                name="nom"
                value="{{ old('nom') }}"
                required
            >
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description') }}</textarea>
        </div>

        <button type="submit">Enregistrer</button>

    </form>

    <a href="{{ route('categories.index') }}">Retour aux catégories</a>

@endsection