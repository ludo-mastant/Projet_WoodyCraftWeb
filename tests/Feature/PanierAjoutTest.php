<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Puzzle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PanierAjoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_puzzle_peut_etre_ajoute_au_panier(): void
    {
        // Création d'une catégorie nécessaire pour rattacher le puzzle
        $categorie = Categorie::create([
            'nom' => 'Animaux',
            'image' => 'animaux.png',
        ]);

        // Création d'un puzzle de test
        $puzzle = Puzzle::create([
            'nom' => 'Puzzle Lion',
            'description' => 'Puzzle 3D en bois représentant un lion.',
            'prix' => 24.99,
            'image' => 'lion.png',
            'categorie_id' => $categorie->id,
        ]);

        // Appel de la route d'ajout au panier
        $response = $this->post('/panier/add/' . $puzzle->id);

        // Vérifie que l'utilisateur est redirigé après l'ajout
        $response->assertRedirect();

        // Vérifie que le panier existe en session
        $this->assertTrue(session()->has('panier'));

        // Récupération du panier
        $panier = session('panier');

        // Vérifie que le puzzle est bien présent dans le panier
        $this->assertArrayHasKey($puzzle->id, $panier);

        // Vérifie les informations du produit dans le panier
        $this->assertEquals('Puzzle Lion', $panier[$puzzle->id]['nom']);
        $this->assertEquals(24.99, $panier[$puzzle->id]['prix']);
        $this->assertEquals(1, $panier[$puzzle->id]['quantite']);
        $this->assertEquals(24.99, $panier[$puzzle->id]['total']);
    }
}