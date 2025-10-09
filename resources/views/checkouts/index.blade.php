<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Payer
        </h2>
    </x-slot>

    <div class="container flex justify-center mx-auto mt-6">
        <div class="flex flex-col w-full">
            {{-- Alerts --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('warning'))
                <div class="mb-4 bg-yellow-100 text-yellow-800 px-4 py-3 rounded">
                    {{ session('warning') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Adresse de livraison --}}
            <div class="border border-gray-200 rounded shadow mb-6">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">Adresse de livraison</h3>
                </div>

                <div class="p-4">
                    @if(!empty($adresse))
                        <div class="text-gray-700">
                            <p class="mb-1"><span class="font-semibold">Numéro :</span> {{ $adresse->numero }}</p>
                            <p class="mb-1"><span class="font-semibold">Rue :</span> {{ $adresse->rue }}</p>
                            <p class="mb-1"><span class="font-semibold">Ville :</span> {{ $adresse->ville }}</p>
                            <p class="mb-1"><span class="font-semibold">Code postal :</span> {{ $adresse->code_postal }}</p>
                        </div>
                    @else
                        <p class="text-gray-500">Aucune adresse enregistrée pour l’instant.</p>
                    @endif

                    <div class="mt-4">
                        <details class="group">
                            <summary class="cursor-pointer text-blue-600 hover:underline">
                                Changer d’adresse
                            </summary>
                            <div class="mt-3">
                                <form action="{{ route('checkout.address.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                    @csrf
                                    <div class="md:col-span-1">
                                        <label class="block text-sm text-gray-600 mb-1">Numéro</label>
                                        <input name="numero" value="{{ old('numero', $adresse->numero ?? '') }}"
                                               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="block text-sm text-gray-600 mb-1">Rue</label>
                                        <input name="rue" value="{{ old('rue', $adresse->rue ?? '') }}"
                                               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                                    </div>
                                    <div class="md:col-span-1">
                                        <label class="block text-sm text-gray-600 mb-1">Ville</label>
                                        <input name="ville" value="{{ old('ville', $adresse->ville ?? '') }}"
                                               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                                    </div>
                                    <div class="md:col-span-1">
                                        <label class="block text-sm text-gray-600 mb-1">Code postal</label>
                                        <input name="code_postal" value="{{ old('code_postal', $adresse->code_postal ?? '') }}"
                                               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                                    </div>
                                    <div class="md:col-span-6 flex justify-end">
                                        <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                                            Enregistrer l’adresse
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
            </div>

            {{-- Récap panier (même structure que ta table panier) --}}
            <div class="border-b border-gray-200 shadow">
                @php $grandTotal = $grandTotal ?? 0; @endphp
                @if(empty($panier))
                    <p class="p-4 text-gray-500">Votre panier est vide.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-xs text-gray-500">Produit</th>
                            <th class="px-4 py-2 text-xs text-gray-500">Prix</th>
                            <th class="px-4 py-2 text-xs text-gray-500">Quantité</th>
                            <th class="px-4 py-2 text-xs text-gray-500">Total</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @php $grandTotal = 0; @endphp
                        @foreach($panier as $id => $item)
                            @php $grandTotal += ($item['total'] ?? (($item['prix'] ?? 0) * ($item['quantite'] ?? 1))); @endphp
                            <tr class="whitespace-nowrap">
                                <td class="px-4 py-4 text-sm text-gray-700">{{ $item['nom'] ?? 'Produit' }}</td>
                                <td class="px-4 py-4 text-sm text-gray-700">
                                    {{ number_format(($item['prix'] ?? 0), 2, ',', ' ') }} €
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-700">
                                    x{{ $item['quantite'] ?? 1 }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-700">
                                    {{ number_format(($item['total'] ?? (($item['prix'] ?? 0)*($item['quantite'] ?? 1))), 2, ',', ' ') }} €
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="px-4 py-2 text-right font-bold">Total général :</td>
                            <td class="px-4 py-2 font-bold">{{ number_format($grandTotal, 2, ',', ' ') }} €</td>
                        </tr>
                        </tfoot>
                    </table>
                @endif
            </div>

            {{-- Bloc Paiement + Validation --}}
            @if(!empty($panier))
                <form action="{{ route('checkout.pay') }}" method="POST" class="mt-6">
                    @csrf

                    {{-- Email de confirmation --}}
                    <div class="border border-gray-200 rounded shadow mb-6">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800">Coordonnées</h3>
                        </div>
                        <div class="p-4">
                            <label class="block text-sm text-gray-600 mb-1">E-mail de confirmation</label>
                            <input type="email" name="email_confirmation"
                                   value="{{ old('email_confirmation', auth()->user()->email ?? '') }}"
                                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
                            @error('email_confirmation')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Moyen de paiement --}}
                    <div class="border border-gray-200 rounded shadow mb-6">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800">Moyen de paiement</h3>
                        </div>
                        <div class="p-4 space-y-3">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="moyen_paiement" value="cheque"
                                       class="h-4 w-4 text-blue-600"
                                       {{ old('moyen_paiement') === 'cheque' ? 'checked' : '' }}>
                                <span>Chèque (générer un PDF)</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="moyen_paiement" value="paypal"
                                       class="h-4 w-4 text-blue-600"
                                       {{ old('moyen_paiement') === 'paypal' ? 'checked' : '' }}>
                                <span>PayPal</span>
                            </label>
                            @error('moyen_paiement')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-black px-5 py-2 rounded shadow">
                            Valider la commande
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
