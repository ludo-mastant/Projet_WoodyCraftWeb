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

    protected $fillable = [
        'nom',
        'image',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/default-category.jpg');
        }

        return Str::startsWith($this->image, ['http://','https://'])
            ? $this->image
            : asset('storage/categories/'.$this->image);
    }
}
