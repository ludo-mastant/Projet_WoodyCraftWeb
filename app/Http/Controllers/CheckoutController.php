<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Adresse;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    /**
     * Page /checkout (auth obligatoire dans les routes).
     * Lit uniquement le panier depuis la session pour éviter toute dépendance BDD.
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // Panier en session (même structure que ta page panier)
        // ex attendu: ['123' => ['nom'=>'Puzzle', 'prix'=>19.99, 'quantite'=>2, 'total'=>39.98], ...]
        $panier = session('panier', []);

        if (empty($panier)) {
            return redirect()->route('panier.show')->with('warning', 'Votre panier est vide.');
        }

        // Adresse (table minimale: utilisateur_id, numero, rue, ville, code_postal)
        $adresse = Adresse::where('utilisateur_id', $user->id)->first();

        // total calculé côté contrôleur (sécurisant)
        $grandTotal = 0;
        foreach ($panier as $item) {
            $qte   = (int)($item['quantite'] ?? 1);
            $prix  = (float)($item['prix'] ?? 0);
            $ligne = isset($item['total']) ? (float)$item['total'] : ($prix * $qte);
            $grandTotal += $ligne;
        }

        // On passe les mêmes variables que ta vue checkout “session”
        return view('checkouts.index', compact('panier', 'adresse', 'grandTotal'));
    }

    /**
     * Mettre à jour ou créer l'adresse (structure minimale).
     */
    public function updateAddress(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'numero'      => ['required','string','max:10'],
            'rue'         => ['required','string','max:255'],
            'ville'       => ['required','string','max:100'],
            'code_postal' => ['required','string','max:10'],
        ]);

        $adresse = Adresse::firstOrNew(['utilisateur_id' => $user->id]);
        $adresse->fill($validated + ['utilisateur_id' => $user->id]);
        $adresse->save();

        return back()->with('success', 'Adresse mise à jour.');
    }

    /**
     * Valider la commande :
     * - si "cheque" => génère un PDF (sans rien écrire en BDD côté panier)
     * - si "paypal" => redirige vers la route de retour (simulation)
     */
    public function pay(Request $request)
    {
        $user   = Auth::user();
        $panier = session('panier', []);

        if (empty($panier)) {
            return redirect()->route('panier.show')->with('warning', 'Votre panier est vide.');
        }

        $adresse = Adresse::where('utilisateur_id', $user->id)->first();
        if (!$adresse) {
            return back()->withErrors(['adresse' => 'Ajoutez une adresse de livraison avant de payer.']);
        }

        $validated = $request->validate([
            'email_confirmation' => ['required','email'],
            'moyen_paiement'     => ['required','in:cheque,paypal'],
        ]);

        // Total recalculé (sécurité)
        $grandTotal = 0;
        foreach ($panier as $item) {
            $qte   = (int)($item['quantite'] ?? 1);
            $prix  = (float)($item['prix'] ?? 0);
            $ligne = isset($item['total']) ? (float)$item['total'] : ($prix * $qte);
            $grandTotal += $ligne;
        }

        if ($validated['moyen_paiement'] === 'cheque') {
            // Générer PDF à partir du panier en session (pas de dépendance aux modèles Panier/Item)
            $pdf = Pdf::loadView('pdf.cheque_session', [
                'user'        => $user,
                'email'       => $validated['email_confirmation'],
                'panier'      => $panier,
                'grandTotal'  => $grandTotal,
                'adresse'     => $adresse,
                'commandeRef' => now()->format('Ymd-His').'-'.($user->id), // petite référence lisible
            ]);

            // (Option) vider le panier après génération si tu souhaites
            // session()->forget('panier');

            return $pdf->download('commande_cheque_'.date('Ymd_His').'.pdf');
        }

        if ($validated['moyen_paiement'] === 'paypal') {
            // Simulation: on va directement à la route de retour
            // (intégration PayPal réelle à faire plus tard)
            return redirect()->route('paypal.return')->with('info', 'Redirection PayPal simulée.');
        }

        return back()->withErrors(['moyen_paiement' => 'Moyen de paiement invalide.']);
    }

    /**
     * Retour PayPal (simulation) : on "confirme" et on peut vider le panier session.
     */
    public function paypalReturn(Request $request)
    {
        // ICI tu vérifieras l’IPN/SDK PayPal plus tard.
        // Pour l’instant: panier validé => on vide la session panier.
        session()->forget('panier');

        return redirect()->route('panier.show')->with('success', 'Paiement PayPal confirmé (simulation). Merci !');
    }

    public function paypalCancel()
    {
        return redirect()->route('checkouts.show')->with('warning', 'Paiement annulé.');
    }
}
