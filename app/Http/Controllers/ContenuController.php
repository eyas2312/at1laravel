<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Categorie;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;

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

$publication = new Publication($donnees);
$publication->user_id = 1;
$publication->save();
    return redirect()->route('contenus.show', $publication)
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
    $contenu->update($request->validated());

    return redirect()->route('contenus.show', $contenu)
        ->with('succes', 'Publication mise à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Publication $contenu)
{
    $contenu->delete();

    return redirect()->route('contenus.index')
        ->with('succes', 'Publication supprimée avec succès.');
}
}
