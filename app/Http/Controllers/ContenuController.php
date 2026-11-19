<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Categorie;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::with(['categorie', 'auteur', 'tags'])
            ->withCount('commentaires')
            ->latest()
            ->paginate(9);
        return view('contenus.index', ['publications' => $publications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Categorie::all();

    return view('contenus.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(StorePublicationRequest $request)
{
    $donnees = $request->validated();

    if ($request->hasFile('image')) {
        $donnees['image'] = $request->file('image')
            ->store('publications', 'public');
    }

    if ($request->hasFile('fichier_media')) {
        $fichier = $request->file('fichier_media');

        $donnees['fichier_media'] = $fichier->store('medias', 'public');

        $donnees['type_media'] = str_starts_with(
            $fichier->getMimeType(),
            'audio'
        ) ? 'audio' : 'video';
    }

    $publication = new Publication($donnees);
    $publication->user_id = auth()->id();
    $publication->save();
    return redirect()->route('contenus.index')
        ->with('succes', 'Publication créée avec succès.');
}

    /**
     * Display the specified resource.
     */
 public function show(Publication $contenu)
{
    $contenu->load(['categorie', 'auteur', 'commentaires.auteur']);

    return view('contenus.show', ['publication' => $contenu]);
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Publication $contenu)
{
    $categories = Categorie::all();

    return view('contenus.edit', [
        'publication' => $contenu,
        'categories' => $categories
    ]);
}

    /**
     * Update the specified resource in storage.
     */

public function update(UpdatePublicationRequest $request, Publication $contenu)
{
    Gate::authorize('update', $contenu);

    $donnees = $request->validated();

    if ($request->hasFile('image')) {
        if ($contenu->image) {
            Storage::disk('public')->delete($contenu->image);
        }

        $donnees['image'] = $request->file('image')
            ->store('publications', 'public');
    }

    $contenu->update($donnees);

    return redirect()->route('contenus.show', $contenu)
        ->with('succes', 'Publication mise à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Publication $contenu)
{
    Gate::authorize('delete', $contenu);

    $contenu->delete();

    return redirect()->route('contenus.index')
        ->with('succes', 'Publication supprimée avec succès.');
}
}
