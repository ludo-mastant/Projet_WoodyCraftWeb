<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public function puzzles()
    {
        return $this->hasMany(\App\Models\Puzzle::class);
    }
}
