<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategorieController extends Controller
{

        public function home()
    {
        $categories = Categorie::query()
            ->orderBy('nom')
            ->take(8)
            ->get();

        return view('welcome', compact('categories'));
    }
    /**
     * Liste des catégories avec recherche + tri
     */
    public function index(Request $request)
    {
        $q    = trim((string) $request->get('q'));
        $sort = $request->get('sort');

        // on suppose que le modèle Categorie a une relation puzzles()
        $query = Categorie::query()->withCount('puzzles');

        // recherche plein texte simple (adapte si ta table n'a pas 'description')
        if ($q !== '') {
            $query->where(function (Builder $b) use ($q) {
                $b->where('nom', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // TRI (uniquement sur les colonnes existantes: nom, puzzles_count)
        switch ($sort) {
            case 'name_asc':
                $query->orderByRaw('LOWER(nom) asc');
                break;
            case 'name_desc':
                $query->orderByRaw('LOWER(nom) desc');
                break;
            case 'count_desc':
                $query->orderBy('puzzles_count', 'desc');
                break;
            case 'count_asc':
                $query->orderBy('puzzles_count', 'asc');
                break;
            default:
                // tri par défaut
                $query->orderByRaw('LOWER(nom) asc');
                break;
        }

        $categories = $query->paginate(12)->withQueryString();

        return view('categories.index', compact('categories'));
    }

    /**
     * Détail d’une catégorie + liste de ses puzzles avec recherche + tri
     */
    public function show(Categorie $category, Request $request)
    {
        $q    = trim((string) $request->get('q'));
        $sort = $request->get('sort');

        $puzzlesQuery = $category->puzzles(); // relation hasMany sur Puzzle

        // recherche sur nom/description
        if ($q !== '') {
            $puzzlesQuery->where(function (Builder $b) use ($q) {
                $b->where('nom', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // TRI (colonnes FR: nom, prix, created_at)
        switch ($sort) {
            case 'price_asc':
                $puzzlesQuery->orderBy('prix', 'asc');
                break;
            case 'price_desc':
                $puzzlesQuery->orderBy('prix', 'desc');
                break;
            case 'name_asc':
                $puzzlesQuery->orderByRaw('LOWER(nom) asc');
                break;
            case 'name_desc':
                $puzzlesQuery->orderByRaw('LOWER(nom) desc');
                break;
            case 'newest':
                $puzzlesQuery->orderBy('created_at', 'desc');
                break;
            default:
                $puzzlesQuery->orderByRaw('LOWER(nom) asc');
                break;
        }

        $puzzles = $puzzlesQuery->paginate(9)->withQueryString();

        return view('categories.show', compact('category', 'puzzles'));
    }
}
