<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    // Liste des publications
    public function index(Request $request)
{
    $query = Publication::with([
        'categorie', 'auteur', 'tags'
    ])->latest();

    if ($request->has('categorie_id')) {
        $query->where('categorie_id', $request->categorie_id);
    }

    $publications = $query->paginate(10);

    return PublicationResource::collection($publications);
}

    // Détail d'une publication
    public function show(Publication $publication)
    {
        return new PublicationResource(
            $publication->load(['categorie', 'auteur', 'tags'])
        );
    }

    // Créer une publication
    public function store(StorePublicationRequest $request)
    {
        $this->authorize('create', Publication::class);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('publications/images', 'public');
        }

        if ($request->hasFile('fichier_media')) {
            $data['fichier_media'] = $request->file('fichier_media')
                ->store('publications/fichiers', 'public');
        }

        $data['user_id'] = $request->user()->id;

        $publication = Publication::create($data);

        return (new PublicationResource($publication))
            ->response()->setStatusCode(201);
    }

    // Modifier une publication
    public function update(
        UpdatePublicationRequest $request,
        Publication $publication
    ) {
        $this->authorize('update', $publication);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($publication->image) {
                Storage::disk('public')->delete($publication->image);
            }

            $data['image'] = $request->file('image')
                ->store('publications/images', 'public');
        }

        if ($request->hasFile('fichier_media')) {
            if ($publication->fichier_media) {
                Storage::disk('public')->delete($publication->fichier_media);
            }

            $data['fichier_media'] = $request->file('fichier_media')
                ->store('publications/fichiers', 'public');
        }

        $publication->update($data);

        return new PublicationResource($publication->load([
            'categorie', 'auteur', 'tags'
        ]));
    }

    // Supprimer une publication
    public function destroy(Publication $publication)
    {
        $this->authorize('delete', $publication);

        $publication->delete();

        return response()->json(null, 204);
    }
}
