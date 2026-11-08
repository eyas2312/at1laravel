@extends('layouts.app')

@section('titre', 'Catégories')

@section('contenu')

    <h1>Liste des catégories</h1>
    <a href="{{ route('categories.create') }}">Ajouter une catégorie</a>
    @forelse ($categories as $categorie)

        <x-carte :titre="$categorie->nom">

            <p>
                {{ $categorie->description ?? 'Aucune description disponible.' }}
            </p>

            <p>
                <strong>Nombre de publications :</strong>
                {{ $categorie->publications_count }}
            </p>
            <a href="{{ route('categories.edit', $categorie->id) }}">
    Modifier
</a>
<form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit"
        onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">
        Supprimer
    </button>

</form>
        </x-carte>

    @empty

        <p>Aucune catégorie disponible pour le moment.</p>

    @endforelse
{{ $categories->links() }}
@endsection