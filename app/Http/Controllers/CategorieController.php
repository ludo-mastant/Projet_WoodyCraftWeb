<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Puzzle;
use Illuminate\Http\Request;



class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date2 = $request->validate([
            'nom' => 'required|max:100',
            'description' => 'required|max:500',
        ]);

        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->description = $request->description;
        $categorie->save();
        return redirect()->route('categories.index')->with('message', "La categorie a bien été modifié !");
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorie = Categorie::with('puzzles')->find($id);
        //$categorie->load('puzzles'); // charge les puzzles
        return view('categories.show', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function home()
    {  
        $categories = Categorie::all(); // récupère toutes les catégories
        return view('welcome', compact('categories')); // passe $categories à la vue accueil
    }

}
