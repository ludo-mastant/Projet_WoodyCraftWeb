<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mon Panier
        </h2>
    </x-slot>

    <div class="container flex justify-center mx-auto mt-6">
        <div class="flex flex-col w-full">
            <div class="border-b border-gray-200 shadow">
                @if(empty($panier))
                    <p class="p-4 text-gray-500">Le panier est vide.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-xs text-gray-500">Produit</th>
                                <th class="px-4 py-2 text-xs text-gray-500">Prix</th>
                                <th class="px-4 py-2 text-xs text-gray-500">Quantité</th>
                                <th class="px-4 py-2 text-xs text-gray-500">Total</th>
                                <th class="px-4 py-2 text-xs text-gray-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $grandTotal = 0; @endphp
                            @foreach($panier as $id => $item)
                                @php $grandTotal += $item['total']; @endphp
                                <tr class="whitespace-nowrap">
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $item['nom'] }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $item['prix'] }} €</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">
                                        <form action="{{ route('panier.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1"
                                                   class="w-20 border rounded px-2 py-1 text-center">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded shadow">
                                                Appliquer
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $item['total'] }} €</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">
                                        <form action="{{ route('panier.remove', $id) }}" method="POST">
                                            @csrf
                                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-100">
                                <td colspan="3" class="px-4 py-2 text-right font-bold">Total général :</td>
                                <td colspan="2" class="px-4 py-2 font-bold">{{ $grandTotal }} €</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('puzzles.index') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Continuer les achats
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
