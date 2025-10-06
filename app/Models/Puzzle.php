<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image',
        'categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(\App\Models\Categorie::class);
    }

    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'puzzle_panier')
                    ->withPivot('quantite');
    }
}

