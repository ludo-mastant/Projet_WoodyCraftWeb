<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Panier extends Component
{
    public $panier;

    // Ajouter une valeur par défaut
    public function __construct($panier = [])
    {
        $this->panier = $panier;
    }

    public function render()
    {
        return view('components.panier');
    }
}

