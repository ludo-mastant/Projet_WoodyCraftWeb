<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Afficher une Categorie')
        </h2>
    </x-slot>

    <x-categories-card>

    <div class="mt-6 bg-white shadow rounded p-4">
        <h3 class="font-semibold text-lg text-gray-800">Films de cette catégorie :</h3>
        @forelse ($categorie->puzzles as $puzzle)
            <h3 class="font-semibold text-xl text-gray-800">@lang('nom')</h3>
            <p>{{ $puzzle->nom }}</p>
        @empty
            <p class="text-gray-500">Aucun film trouvé.</p>
        @endforelse
    </div>

    </x-categories-card>
</x-app-layout>