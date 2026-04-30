<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-7xl w-full">

            {{-- En-tête --}}
            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Liste des <span class="text-[#3aa3e3]">Puzzles</span>
                </h1>

                <p class="mt-2 text-[#1f3b57]/80">
                    Découvre les puzzles disponibles sur WoodyCraft
                </p>
            </header>

            {{-- Filtre fournisseur --}}
            <form method="GET"
                  action="{{ route('puzzles.index') }}"
                  class="mb-8 bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 py-5">

                <label for="fournisseur_id" class="block mb-2 font-semibold text-[#1e3b57]">
                    Filtrer les puzzles par fournisseur
                </label>

                <div class="flex flex-col sm:flex-row gap-3">
                    <select
                        name="fournisseur_id"
                        id="fournisseur_id"
                        class="w-full sm:w-80 px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] outline-none focus:ring-2 focus:ring-[#3aa3e3]/50"
                    >
                        <option value="">Tous les fournisseurs</option>

                        @foreach(($fournisseurs ?? collect()) as $fournisseur)
                            <option value="{{ $fournisseur->id }}"
                                @selected(request('fournisseur_id') == $fournisseur->id)>
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach
                    </select>

                    <button
                        type="submit"
                        class="px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95"
                    >
                        Filtrer
                    </button>

                    <a
                        href="{{ route('puzzles.index') }}"
                        class="px-5 py-3 rounded-2xl font-semibold bg-white/90 text-[#1e3b57] border border-white/50 hover:opacity-90 transition text-center"
                    >
                        Réinitialiser
                    </a>
                </div>
            </form>

            {{-- Liste des puzzles --}}
            <section class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-4 md:px-6 py-8">

                @if($puzzles->count() === 0)
                    <div class="text-center py-12">
                        <p class="text-[#1f3b57]/80 text-lg">
                            Aucun puzzle trouvé pour ce fournisseur.
                        </p>

                        <a href="{{ route('puzzles.index') }}"
                           class="inline-flex mt-5 px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition">
                            Voir tous les puzzles
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach($puzzles as $puzzle)
                            <article class="bg-white/90 rounded-3xl shadow-xl border border-white/40 overflow-hidden hover:-translate-y-1 transition">

                                {{-- Image --}}
                                <div class="h-56 bg-white/70 flex items-center justify-center p-5">
                                    @if($puzzle->image)
                                        <img src="{{ asset($puzzle->image) }}"
                                             alt="{{ $puzzle->nom }}"
                                             class="max-h-full w-full object-contain rounded-2xl">
                                    @else
                                        <div class="w-full h-full rounded-2xl bg-[#1e3b57]/10 flex items-center justify-center">
                                            <span class="text-[#1e3b57]/70">
                                                Aucune image
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Contenu --}}
                                <div class="p-6">
                                    <h2 class="text-xl font-bold text-[#1e3b57] mb-2">
                                        {{ $puzzle->nom }}
                                    </h2>

                                    <p class="text-sm text-[#1f3b57]/70 mb-1">
                                        Catégorie :
                                        <span class="font-semibold">
                                            {{ $puzzle->categorie ? $puzzle->categorie->nom : 'Non renseignée' }}
                                        </span>
                                    </p>

                                    <p class="text-sm text-[#1f3b57]/70 mb-4">
                                        Fournisseur :
                                        <span class="font-semibold">
                                            {{ $puzzle->fournisseur ? $puzzle->fournisseur->nom : 'Non renseigné' }}
                                        </span>
                                    </p>

                                    <p class="text-[#1f3b57]/80 text-sm leading-relaxed mb-5">
                                        {{ Str::limit($puzzle->description, 100) }}
                                    </p>

                                    <div class="flex items-center justify-between mb-5">
                                        <p class="text-2xl font-extrabold text-[#1e3b57]">
                                            {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                                        </p>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex flex-col gap-3">
                                        <a href="{{ route('puzzles.show', $puzzle) }}"
                                           class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
                                            Voir le puzzle
                                        </a>

                                        <form action="{{ url('/panier/add/' . $puzzle->id) }}" method="POST">
                                            @csrf

                                            <button type="submit"
                                                    class="w-full inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
                                                Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach

                    </div>
                @endif

            </section>

        </div>
    </div>
</x-app-layout>