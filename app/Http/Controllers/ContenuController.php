<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Categorie;
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
   public function store(Request $request)
{
    $publication = Publication::create([
        'titre' => $request->input('titre'),
        'contenu' => $request->input('contenu'),
        'categorie_id' => $request->input('categorie_id'),
        'user_id' => 1,
    ]);

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
  public function update(Request $request, Publication $contenu)
{
    $contenu->update([
        'titre' => $request->input('titre'),
        'contenu' => $request->input('contenu'),
        'categorie_id' => $request->input('categorie_id'),
    ]);

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
