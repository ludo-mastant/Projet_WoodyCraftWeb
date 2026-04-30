<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-4xl w-full">

            {{-- En-tête --}}
            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Ajouter un <span class="text-[#3aa3e3]">Fournisseur</span>
                </h1>

                <p class="mt-2 text-[#1f3b57]/80">
                    Renseigne le nom et l’adresse du fournisseur
                </p>
            </header>

            {{-- Formulaire --}}
            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-8 py-8">
                <form action="{{ route('fournisseurs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nom" class="block mb-2 font-semibold text-[#1e3b57]">
                            Nom du fournisseur
                        </label>

                        <input type="text"
                               name="nom"
                               id="nom"
                               value="{{ old('nom') }}"
                               placeholder="Exemple : WoodStock 3D"
                               class="w-full px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] outline-none focus:ring-2 focus:ring-[#3aa3e3]/50">

                        @error('nom')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="adresse" class="block mb-2 font-semibold text-[#1e3b57]">
                            Adresse
                        </label>

                        <input type="text"
                               name="adresse"
                               id="adresse"
                               value="{{ old('adresse') }}"
                               placeholder="Exemple : 10 rue du Bois, 69000 Lyon"
                               class="w-full px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] outline-none focus:ring-2 focus:ring-[#3aa3e3]/50">

                        @error('adresse')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="submit"
                                class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
                            Enregistrer
                        </button>

                        <a href="{{ route('fournisseurs.index') }}"
                           class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-white/90 text-[#1e3b57] border border-white/50 hover:opacity-90 transition">
                            Annuler
                        </a>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>