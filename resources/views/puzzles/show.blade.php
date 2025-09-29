<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Afficher un puzzle')
        </h2>
    </x-slot>

    <x-puzzles-card>
        <h3 class="font-semibold text-xl text-gray-800">@lang('Nom')</h3>
        <p>{{ $puzzle->nom }}</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Catégorie')</h3>
        <p>{{ $puzzle->categorie }}</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Description')</h3>
        <p>{{ $puzzle->description }}</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Date de création')</h3>
        <p>{{ $puzzle->created_at->format('d/m/Y') }}</p>

        @if ($puzzle->created_at != $puzzle->updated_at)
            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Dernière mise à jour')</h3>
            <p>{{ $puzzle->updated_at->format('d/m/Y') }}</p>
        @endif
    </x-puzzles-card>
</x-app-layout>
