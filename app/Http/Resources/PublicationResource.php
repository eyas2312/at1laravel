<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PublicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'contenu' => $this->contenu,
            'categorie_id' => $this->categorie_id,
            'categorie' => $this->categorie?->nom,
            'auteur' => $this->auteur?->name,
            'image' => $this->image
                ? Storage::disk('public')->url($this->image)
                : null,
            'fichier_media' => $this->fichier_media
                ? Storage::disk('public')->url($this->fichier_media)
                : null,
            'type_media' => $this->type_media,
            'tags' => $this->tags->pluck('nom'),
            'publie_le' => $this->created_at?->toDateString(),
        ];
    }
}
