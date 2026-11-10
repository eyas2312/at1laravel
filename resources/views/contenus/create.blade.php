@extends('layouts.app')

@section('titre', 'Ajouter une publication')

@section('contenu')

    <h1>Ajouter une publication</h1>
@if ($errors->any())
    <ul class="erreurs">
        @foreach ($errors->all() as $erreur)
            <li>{{ $erreur }}</li>
        @endforeach
    </ul>
@endif
    <form action="{{ route('contenus.store') }}" method="POST">

        @csrf

        <div>
            <label for="titre">Titre :</label>
            <input
                type="text"
                id="titre"
                name="titre"
                value="{{ old('titre') }}"
                required
            >
@error('titre')
    <span class="erreur-champ">{{ $message }}</span>
@enderror

        </div>

        <div>
            <label for="contenu">Contenu :</label>
            <textarea
                id="contenu"
                name="contenu"
                required
            >{{ old('contenu') }}</textarea>
            @error('contenu')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <div>
            <label for="categorie_id">Catégorie :</label>
            <select name="categorie_id" id="categorie_id" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <button type="submit">Enregistrer</button>

    </form>

    <a href="{{ route('contenus.index') }}">Retour aux publications</a>

@endsection