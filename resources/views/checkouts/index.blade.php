<x-app-layout>
    @php
        $user = Auth::user();

        $numeroValue = old('numero', $adresse->numero ?? '');
        $rueValue = old('rue', $adresse->rue ?? ($user->adresse ?? ''));
        $villeValue = old('ville', $adresse->ville ?? '');
        $codePostalValue = old('code_postal', $adresse->code_postal ?? '');
        $emailConfirmationValue = old('email_confirmation', $user->email ?? '');
        $grandTotal = $grandTotal ?? 0;
    @endphp

    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">
            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl px-6 md:px-10 py-10 border border-white/30">
                <div class="text-center mb-10">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                        Paiement
                    </h1>
                    <p class="text-[#1f3b57]/80 mt-3">
                        Finalise ta commande WoodyCraft
                    </p>
                </div>

                {{-- Alertes --}}
                @if(session('success'))
                    <div class="mb-4 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="mb-4 rounded-2xl border border-yellow-200 bg-yellow-50 px-4 py-3 text-yellow-700 shadow-sm">
                        {{ session('warning') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-red-700 shadow-sm">
                        <p class="font-semibold mb-2">Merci de corriger les erreurs suivantes :</p>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    {{-- Colonne gauche --}}
                    <div class="xl:col-span-2 space-y-6">
                        {{-- Adresse --}}
                        <div class="bg-white/90 border border-white/30 rounded-3xl shadow-lg p-6">
                            <div class="flex items-center justify-between mb-5">
                                <h2 class="text-2xl font-bold text-[#1e3b57]">
                                    Adresse de livraison
                                </h2>
                            </div>

                            @if(!empty($adresse))
                                <div class="mb-6 rounded-2xl bg-[#f7ede2] border border-[#ead9c7] p-4 text-[#1e3b57]">
                                    <p class="font-semibold mb-2">Adresse enregistrée</p>
                                    <div class="space-y-1 text-sm md:text-base">
                                        <p><span class="font-medium">Numéro :</span> {{ $adresse->numero }}</p>
                                        <p><span class="font-medium">Rue :</span> {{ $adresse->rue }}</p>
                                        <p><span class="font-medium">Ville :</span> {{ $adresse->ville }}</p>
                                        <p><span class="font-medium">Code postal :</span> {{ $adresse->code_postal }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="mb-6 rounded-2xl bg-[#f7ede2] border border-[#ead9c7] p-4 text-[#1e3b57]">
                                    <p class="font-semibold mb-1">Aucune adresse détaillée enregistrée.</p>
                                    <p class="text-sm text-[#1f3b57]/80">
                                        Si tu as renseigné une adresse à l’inscription, elle est reprise ci-dessous dans le champ rue.
                                    </p>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('checkout.address.update') }}" class="space-y-4">
                                @csrf

                                <h3 class="text-lg font-semibold text-[#1e3b57]">
                                    {{ !empty($adresse) ? 'Modifier l’adresse' : 'Ajouter une adresse' }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="numero" class="block text-sm font-medium text-[#1e3b57] mb-1">
                                            Numéro
                                        </label>
                                        <input
                                            type="text"
                                            id="numero"
                                            name="numero"
                                            value="{{ $numeroValue }}"
                                            class="w-full rounded-2xl border border-[#d8c7b5] bg-white px-4 py-3 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                                            placeholder="Ex : 12"
                                        >
                                    </div>

                                    <div>
                                        <label for="code_postal" class="block text-sm font-medium text-[#1e3b57] mb-1">
                                            Code postal
                                        </label>
                                        <input
                                            type="text"
                                            id="code_postal"
                                            name="code_postal"
                                            value="{{ $codePostalValue }}"
                                            class="w-full rounded-2xl border border-[#d8c7b5] bg-white px-4 py-3 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                                            placeholder="Ex : 69000"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label for="rue" class="block text-sm font-medium text-[#1e3b57] mb-1">
                                        Rue
                                    </label>
                                    <input
                                        type="text"
                                        id="rue"
                                        name="rue"
                                        value="{{ $rueValue }}"
                                        class="w-full rounded-2xl border border-[#d8c7b5] bg-white px-4 py-3 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                                        placeholder="Ex : Rue de la République"
                                    >
                                </div>

                                <div>
                                    <label for="ville" class="block text-sm font-medium text-[#1e3b57] mb-1">
                                        Ville
                                    </label>
                                    <input
                                        type="text"
                                        id="ville"
                                        name="ville"
                                        value="{{ $villeValue }}"
                                        class="w-full rounded-2xl border border-[#d8c7b5] bg-white px-4 py-3 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                                        placeholder="Ex : Lyon"
                                    >
                                </div>

                                <div class="pt-2">
                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center rounded-full bg-[#1e3b57] px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-[#163047]"
                                    >
                                        Enregistrer l’adresse
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Paiement --}}
                        @if(!empty($panier))
                            <div class="bg-white/90 border border-white/30 rounded-3xl shadow-lg p-6">
                                <h2 class="text-2xl font-bold text-[#1e3b57] mb-5">
                                    Coordonnées et paiement
                                </h2>

                                <form method="POST" action="{{ route('checkout.pay') }}" class="space-y-6">
                                    @csrf

                                    <div>
                                        <label for="email_confirmation" class="block text-sm font-medium text-[#1e3b57] mb-1">
                                            E-mail de confirmation
                                        </label>
                                        <input
                                            type="email"
                                            id="email_confirmation"
                                            name="email_confirmation"
                                            value="{{ $emailConfirmationValue }}"
                                            class="w-full rounded-2xl border border-[#d8c7b5] bg-white px-4 py-3 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                                            placeholder="ton@email.com"
                                        >
                                        @error('email_confirmation')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <p class="block text-sm font-medium text-[#1e3b57] mb-3">
                                            Moyen de paiement
                                        </p>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <label class="cursor-pointer rounded-2xl border border-[#d8c7b5] bg-[#f7ede2] px-4 py-4 hover:border-[#1e3b57] transition">
                                                <div class="flex items-center gap-3">
                                                    <input
                                                        type="radio"
                                                        name="moyen_paiement"
                                                        value="cheque"
                                                        class="text-[#1e3b57] focus:ring-[#1e3b57]"
                                                        {{ old('moyen_paiement') === 'cheque' ? 'checked' : '' }}
                                                    >
                                                    <div>
                                                        <p class="font-semibold text-[#1e3b57]">Chèque</p>
                                                        <p class="text-sm text-[#1f3b57]/80">Un PDF de commande sera généré.</p>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="cursor-pointer rounded-2xl border border-[#d8c7b5] bg-[#f7ede2] px-4 py-4 hover:border-[#1e3b57] transition">
                                                <div class="flex items-center gap-3">
                                                    <input
                                                        type="radio"
                                                        name="moyen_paiement"
                                                        value="paypal"
                                                        class="text-[#1e3b57] focus:ring-[#1e3b57]"
                                                        {{ old('moyen_paiement') === 'paypal' ? 'checked' : '' }}
                                                    >
                                                    <div>
                                                        <p class="font-semibold text-[#1e3b57]">PayPal</p>
                                                        <p class="text-sm text-[#1f3b57]/80">Redirection simulée pour le moment.</p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        @error('moyen_paiement')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="pt-2">
                                        <button
                                            type="submit"
                                            class="w-full inline-flex items-center justify-center rounded-full bg-[#1e3b57] px-6 py-3 text-sm md:text-base font-semibold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-[#163047]"
                                        >
                                            Valider la commande
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Colonne droite --}}
                    <div class="xl:col-span-1">
                        <div class="bg-white/90 border border-white/30 rounded-3xl shadow-lg p-6 sticky top-28">
                            <h2 class="text-2xl font-bold text-[#1e3b57] mb-5">
                                Récapitulatif
                            </h2>

                            @if(empty($panier))
                                <div class="rounded-2xl bg-[#f7ede2] border border-[#ead9c7] p-4 text-[#1e3b57]">
                                    Votre panier est vide.
                                </div>
                            @else
                                @php $grandTotal = 0; @endphp

                                <div class="space-y-4">
                                    @foreach($panier as $id => $item)
                                        @php
                                            $ligneTotal = $item['total'] ?? (($item['prix'] ?? 0) * ($item['quantite'] ?? 1));
                                            $grandTotal += $ligneTotal;
                                        @endphp

                                        <div class="rounded-2xl border border-[#ead9c7] bg-[#fdfaf6] p-4">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <p class="font-semibold text-[#1e3b57]">
                                                        {{ $item['nom'] ?? 'Produit' }}
                                                    </p>
                                                    <p class="text-sm text-[#1f3b57]/75 mt-1">
                                                        Quantité : x{{ $item['quantite'] ?? 1 }}
                                                    </p>
                                                    <p class="text-sm text-[#1f3b57]/75">
                                                        Prix unitaire : {{ number_format(($item['prix'] ?? 0), 2, ',', ' ') }} €
                                                    </p>
                                                </div>

                                                <p class="font-bold text-[#1e3b57] whitespace-nowrap">
                                                    {{ number_format($ligneTotal, 2, ',', ' ') }} €
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 border-t border-[#e5d5c3] pt-4">
                                    <div class="flex items-center justify-between text-lg font-bold text-[#1e3b57]">
                                        <span>Total général</span>
                                        <span>{{ number_format($grandTotal, 2, ',', ' ') }} €</span>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a
                                        href="{{ route('paniers.index') }}"
                                        class="inline-flex items-center justify-center w-full rounded-full border border-[#1e3b57] px-6 py-3 text-sm font-semibold text-[#1e3b57] transition hover:bg-[#1e3b57] hover:text-white"
                                    >
                                        Retour au panier
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>