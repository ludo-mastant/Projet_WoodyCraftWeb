@php
    $panier = $panier ?? $this->panier;
@endphp

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Mon Panier</h1>

    @if(empty($panier))
        <p>Le panier est vide.</p>
    @else
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Produit</th>
                    <th class="border p-2">Prix</th>
                    <th class="border p-2">Quantité</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>

        <a href="{{ route('puzzles.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">
            Continuer les achats
        </a>
    @endif
</div>
