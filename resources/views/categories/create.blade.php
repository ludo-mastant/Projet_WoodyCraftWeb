<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une catégorie') }}
        </h2>
    </x-slot>

    <x-categories-card> <!-- Tu peux le renommer en x-categories-card si tu veux séparer -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <!-- Nom de la catégorie -->
            <div>
                <x-input-label for="nom" :value="__('Nom de la catégorie')" />

                <x-text-input
                    id="nom"
                    class="block mt-1 w-full"
                    type="text"
                    name="nom"
                    :value="old('nom')"
                    required
                    autofocus
                />

                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <!-- Description de la catégorie -->
            <div>
                <x-input-label for="description" :value="__('Description de la catégorie')" />

                <x-text-input
                    id="description"
                    class="block mt-1 w-full"
                    type="text"
                    name="description"
                    :value="old('description')"
                    required
                    autofocus
                />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Créer') }}
                </x-primary-button>
            </div>
        </form>
    </x-categories-card>
</x-app-layout>

