<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Un tag peut appartenir à plusieurs publications
    public function publications()
    {
        return $this->belongsToMany(Publication::class);
    }
}