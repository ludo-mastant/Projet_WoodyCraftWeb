<x-app-layout>
    {{-- Fond et conteneur comme sur welcome.blade.php --}}
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">

            {{-- En-tête stylé --}}
            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Mon <span class="text-[#3aa3e3]">Panier</span>
                </h1>
                <p class="mt-2 text-[#1f3b57]/80">Vérifie tes articles avant le paiement.</p>
            </header>

            {{-- Carte principale (glass) --}}
            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-10 py-8">

                @if(empty($panier))
                    <div class="text-center py-10">
                        <p class="text-[#1f3b57]/80 text-lg">Ton panier est vide pour le moment.</p>
                        <a href="{{ route('puzzles.index') }}"
                           class="inline-flex items-center gap-2 mt-6 px-6 py-3 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
                            Continuer les achats
                        </a>
                    </div>
                @else
                    {{-- Table responsive avec le style d'accueil --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="text-[#1e3b57] text-sm uppercase tracking-wide">
                                    <th class="px-4 py-3">Produit</th>
                                    <th class="px-4 py-3">Prix</th>
                                    <th class="px-4 py-3">Quantité</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/60">
                                @php $grandTotal = 0; @endphp
                                @foreach($panier as $id => $item)
                                    @php $grandTotal += $item['total']; @endphp
                                    <tr class="whitespace-nowrap">
                                        <td class="px-4 py-4 text-[#1f3b57] font-medium">{{ $item['nom'] }}</td>
                                        <td class="px-4 py-4 text-[#1f3b57]">{{ $item['prix'] }} €</td>
                                        <td class="px-4 py-4">
                                            <form action="{{ route('panier.update', $id) }}" method="POST" class="flex items-center gap-3">
                                                @csrf
                                                <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1"
                                                       class="w-24 px-3 py-2 rounded-2xl border border-white/50 bg-white/80 text-center text-[#1e3b57] outline-none focus:ring-2 focus:ring-[#3aa3e3]/50">
                                                <button type="submit"
                                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-[#1e3b57] text-white font-semibold hover:opacity-90 transition active:scale-95">
                                                    Appliquer
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-4 py-4 text-[#1f3b57] font-semibold">{{ $item['total'] }} €</td>
                                        <td class="px-4 py-4">
                                            <form action="{{ route('panier.remove', $id) }}" method="POST">
                                                @csrf
                                                <button class="inline-flex items-center gap-2 px-3 py-2 rounded-2xl bg-red-500 text-white hover:bg-red-600 transition active:scale-95">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-white/60">
                                    <td colspan="3" class="px-4 py-3 text-right font-bold text-[#1e3b57]">Total général :</td>
                                    <td colspan="2" class="px-4 py-3 font-extrabold text-[#1e3b57]">{{ $grandTotal }} €</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="{{ route('puzzles.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl font-semibold bg-white/80 text-[#1e3b57] border border-white/50 shadow hover:bg-white transition active:scale-95">
                            Continuer les achats
                        </a>

                        @auth
                            <a href="{{ route('checkout.show') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
                                Payer
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
                                Se connecter pour payer
                            </a>
                        @endauth
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>