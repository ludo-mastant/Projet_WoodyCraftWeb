<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    protected $fillable = [
        'utilisateur_id','numero','rue',
        'ville','code_postal'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}

