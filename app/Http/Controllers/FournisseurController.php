<?php

namespace App\Http\Controllers;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        Fournisseur::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
        ]);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès.');
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        $fournisseur->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
        ]);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur modifié avec succès.');
    }

    public function show(Fournisseur $fournisseur)
    {
        $fournisseur->load('puzzles');

        return view('fournisseurs.show', compact('fournisseur'));
    }

    public function destroy(Fournisseur $fournisseur)
    {
        if ($fournisseur->puzzles()->exists()) {
            return redirect()
                ->route('fournisseurs.index')
                ->with('error', 'Impossible de supprimer ce fournisseur car il est lié à un ou plusieurs puzzles.');
        }

        $fournisseur->delete();

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur supprimé avec succès.');
    }
}