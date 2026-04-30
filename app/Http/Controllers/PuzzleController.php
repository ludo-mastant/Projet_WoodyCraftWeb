<?php

namespace App\Http\Controllers;
use App\Models\Puzzle;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();
    
        $puzzles = Puzzle::with(['categorie', 'fournisseur'])
            ->when($request->filled('fournisseur_id'), function ($query) use ($request) {
                $query->where('fournisseur_id', $request->fournisseur_id);
            })
            ->get();
    
        return view('puzzles.index', compact('puzzles', 'fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('puzzles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = $request->validate([
            'nom' => 'required|max:100',
            'categorie' => 'required|max:100',
            'description' => 'required|max:500',
            'image' => 'required|max:100',
            'prix' => 'required|numeric|between:0,99.99',
        ]);

        $puzzle = new Puzzle();
        $puzzle->nom = $request->nom;
        $puzzle->categorie = $request->categorie;
        $puzzle->description = $request->description;
        $puzzle->image = $request->image;
        $puzzle->prix = $request->prix;
        $puzzle->save();
        return redirect()->route('puzzles.index')->with('message', "Le puzzle a bien été modifié !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Puzzle $puzzle)
    {
        $puzzle->load(['categorie', 'fournisseur']);
    
        return view('puzzles.show', compact('puzzle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puzzle $puzzle)
    {
        return view('puzzles.edit', compact('puzzle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puzzle $puzzle)
    {
        $data = $request->validate([
            'nom' => 'required|max:100',
            'categorie' => 'required|max:100',
            'description' => 'required|max:500',
            'image' => 'required|max:500',
        ]);
    
        $puzzle->nom = $request->nom;
        $puzzle->categorie = $request->categorie;
        $puzzle->description = $request->description;
        $puzzle->image = $request->image;
        $puzzle->save();
        return redirect()->route('puzzles.index')->with('message', "Le puzzle a bien été modifié !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puzzle $puzzle)
    {
        $puzzle->delete();
        return redirect()->route('puzzles.index')->with('message', "Le puzzle a bien été supprimé");
    }
}
