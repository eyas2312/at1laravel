<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
       use HasFactory, SoftDeletes;
protected $fillable = [
    'titre',
    'contenu',
    'categorie_id',
    'user_id',
    'image',
    'fichier_media',
    'type_media'
];
public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Une publication possède plusieurs commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    // Une publication appartient à un auteur
    public function auteur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   protected static function booted(): void
{
    static::deleting(function (Publication $p) {
        if ($p->image) {
            Storage::disk('public')->delete($p->image);
        }

        if ($p->fichier_media) {
            Storage::disk('public')->delete($p->fichier_media);
        }
    });
}
    // Une publication peut avoir plusieurs tags
   
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}