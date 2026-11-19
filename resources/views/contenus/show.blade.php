@extends('layouts.app')

@section('titre', $publication->titre)

@section('contenu')

    <h1>{{ $publication->titre }}</h1>

    <p>{{ $publication->contenu }}</p>

    <hr>

    <p>
        <strong>Catégorie :</strong>
        {{ $publication->categorie?->nom ?? 'Sans catégorie' }}
    </p>

    <p>
        <strong>Auteur :</strong>
        {{ $publication->auteur?->name ?? 'Auteur inconnu' }}
    </p>
@can('update', $publication)
    <a href="{{ route('contenus.edit', $publication) }}">
        Modifier
    </a>
@endcan

@can('delete', $publication)
    <form action="{{ route('contenus.destroy', $publication) }}"
          method="POST">
        @csrf
        @method('DELETE')

        <button type="submit"
                onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')">
            Supprimer
        </button>
    </form>
@endcan

<hr>
    <hr>

    <h2>Commentaires</h2>

    @forelse ($publication->commentaires as $commentaire)

        <div>
            <p>{{ $commentaire->contenu }}</p>
            <small>
                Par {{ $commentaire->auteur?->name ?? 'Auteur inconnu' }}
            </small>
        </div>

    @empty

        <p>Aucun commentaire pour cette publication.</p>

    @endforelse

    <a href="{{ route('contenus.index') }}">Retour aux publications</a>

@endsection