@extends('layouts.app')

@section('titre', 'Contenus')

@section('contenu')

    <h1>Publications multimédias</h1>

    @forelse ($publications as $publication)

        <x-carte :titre="$publication->titre">

            <p>{{ $publication->contenu }}</p>

            <p>
                <strong>Catégorie :</strong>
                {{ $publication->categorie?->nom ?? 'Sans catégorie' }}
            </p>

            <p>
                <strong>Auteur :</strong>
                {{ $publication->auteur?->name ?? 'Auteur inconnu' }}
            </p>
            <p>
                <strong>Tags :</strong>

                @forelse ($publication->tags as $tag)
                    <span>{{ $tag->nom }}</span>
                @empty
                    <span>Aucun tag</span>
                @endforelse
            </p>
            <p>
    <strong>Nombre de commentaires :</strong>
    {{ $publication->commentaires_count }}
</p>
            <a href="{{ route('contenus.show', $publication->id) }}">
                Voir les détails
            </a>
        </x-carte>

    @empty

        <p>Aucune publication disponible pour le moment.</p>

    @endforelse

    {{ $publications->links() }}

@endsection