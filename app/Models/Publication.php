<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Publication extends Model
{
       use HasFactory, SoftDeletes;
    protected $fillable = ['titre', 'contenu', 'user_id', 'categorie_id']; // Une publication appartient à une catégorie
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
    // Une publication peut avoir plusieurs tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}