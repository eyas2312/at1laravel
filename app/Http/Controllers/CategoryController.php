<?php
namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Http\Requests\UpdateCategorieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories.liste', 3600, function () {
            return Categorie::withCount('publications')->get();
        });

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $categories = new LengthAwarePaginator(
            $categories->forPage($page, $perPage)->values(),
            $categories->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Categorie::create($request->only('nom', 'description'));

        Cache::forget('categories.liste');

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

        Cache::forget('categories.liste');

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

        Cache::forget('categories.liste');

        return redirect()->route('categories.index')
            ->with('succes', 'Catégorie supprimée avec succès.');
    }
}
