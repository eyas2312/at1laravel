<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('publications')->paginate(5);
        return view('categories.index', compact('categories'));
    }
    public function create()
{
    return view('categories.create');
}

public function store(Request $request)
{
    $categorie = Categorie::create($request->only('nom', 'description'));

    return redirect()->route('categories.index')
        ->with('succes', 'Catégorie créée avec succès.');
}
public function edit(Categorie $category)
{
    return view('categories.edit', compact('category'));
}

public function update(UpdateCategorieRequest $request, Categorie $category)
{
    $category->update($request->validated());

    return redirect()->route('categories.index')
        ->with('succes', 'Catégorie mise à jour avec succès.');
}

public function destroy(Categorie $category)
{
    if ($category->publications()->exists()) {
        return redirect()->route('categories.index')
            ->with('erreur', 'Impossible de supprimer cette catégorie : elle contient encore des publications.');
    }

    $category->delete();

    return redirect()->route('categories.index')
        ->with('succes', 'Catégorie supprimée avec succès.');
}
}