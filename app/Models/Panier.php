<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    // Ici tu peux définir les colonnes "fillable" si tu veux le mass assignment
    protected $fillable = ['tilte', 'content'];

    public function puzzles()
    {
        return $this->belongsToMany(Puzzle::class, 'puzzle_panier')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}
