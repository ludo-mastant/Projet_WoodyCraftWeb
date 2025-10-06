<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;


class PanierController extends Controller
{
    public function add(Request $request, $id)
    {
        $puzzle = Puzzle::findOrFail($id);
        $panier = session()->get('panier', []);

        if(isset($panier[$id])) {
            $panier[$id]['quantite']++;
        } else {
            $panier[$id] = [
                "nom" => $puzzle->nom,
                "prix" => $puzzle->prix,
                "quantite" => 1
            ];
        }
        // Mettre à jour le total par produit
        $panier[$id]['total'] = $panier[$id]['prix'] * $panier[$id]['quantite'];

        session()->put('panier', $panier);

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function index()
    {
        $panier = session()->get('panier', []);

        // Assurer que chaque produit a une clé 'total'
        foreach($panier as $id => $item) {
            if(!isset($item['total'])) {
                $panier[$id]['total'] = $item['prix'] * $item['quantite'];
            }
        }

        session()->put('panier', $panier); // mettre à jour la session
        return view('paniers.index', compact('panier'));
    }


    public function remove($id)
    {
        $panier = session()->get('panier', []);
        if(isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    public function update(Request $request, $id)
    {
        $panier = session()->get('panier', []);

        if(isset($panier[$id])) {
            $quantite = (int) $request->input('quantite', 1);

            if($quantite > 0) {
                $panier[$id]['quantite'] = $quantite;
                $panier[$id]['total'] = $panier[$id]['prix'] * $quantite; // mettre à jour total
            } else {
                unset($panier[$id]); // supprimer si quantité <= 0
            }

            session()->put('panier', $panier); // **mettre à jour la session**
        }

        return redirect()->back()->with('success', 'Quantité mise à jour.');
    }


}
