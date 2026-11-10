@extends('layouts.app')

@section('titre', 'Modifier une publication')

@section('contenu')

    <h1>Modifier une publication</h1>
@if ($errors->any())
    <ul class="erreurs">
        @foreach ($errors->all() as $erreur)
            <li>{{ $erreur }}</li>
        @endforeach
    </ul>
@endif
    <form action="{{ route('contenus.update', $publication->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div>
            <label for="titre">Titre :</label>
            <input
                type="text"
                id="titre"
                name="titre"
                value="{{ old('titre', $publication->titre) }}"
                required
            >
           @error('titre')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <div>
            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" required>{{ old('contenu', $publication->contenu) }}</textarea>
        @error('contenu')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <div>
            <label for="categorie_id">Catégorie :</label>
            <select name="categorie_id" id="categorie_id" required>
                @foreach ($categories as $categorie)
                    <option
                        value="{{ $categorie->id }}"
                        @selected($publication->categorie_id == $categorie->id)
                    >
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id')
    <span class="erreur-champ">{{ $message }}</span>
@enderror
        </div>

        <button type="submit">Enregistrer les modifications</button>

    </form>

    <a href="{{ route('contenus.index') }}">Retour aux publications</a>

@endsection