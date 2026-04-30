<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-5xl w-full">

            {{-- En-tête --}}
            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Détail du <span class="text-[#3aa3e3]">Puzzle</span>
                </h1>

                <p class="mt-2 text-[#1f3b57]/80">
                    Consulte les informations du puzzle sélectionné
                </p>
            </header>

            {{-- Carte détail --}}
            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                    {{-- Image --}}
                    <div class="bg-white/60 flex items-center justify-center p-8">
                        @if($puzzle->image)
                            <img src="{{ asset($puzzle->image) }}"
                                 alt="{{ $puzzle->nom }}"
                                 class="max-h-80 w-full object-contain rounded-2xl">
                        @else
                            <div class="w-full h-72 rounded-2xl bg-[#1e3b57]/10 flex items-center justify-center">
                                <span class="text-[#1e3b57]/70">
                                    Aucune image disponible
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Informations --}}
                    <div class="p-8 md:p-10">
                        <h2 class="text-3xl font-extrabold text-[#1e3b57] mb-4">
                            {{ $puzzle->nom }}
                        </h2>

                        <div class="space-y-5 text-[#1f3b57]">

                            <div>
                                <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                                    Catégorie
                                </p>

                                <p class="text-lg font-semibold">
                                    {{ $puzzle->categorie ? $puzzle->categorie->nom : 'Non renseignée' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                                    Fournisseur
                                </p>

                                <p class="text-lg font-semibold">
                                    {{ $puzzle->fournisseur ? $puzzle->fournisseur->nom : 'Non renseigné' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                                    Description
                                </p>

                                <p class="text-base leading-relaxed">
                                    {{ $puzzle->description }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                                    Prix
                                </p>

                                <p class="text-2xl font-bold text-[#1e3b57]">
                                    {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                                </p>
                            </div>

                            <div>
                                <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                                    Date de création
                                </p>

                                <p>
                                    {{ $puzzle->created_at ? $puzzle->created_at->format('d/m/Y') : 'Non renseignée' }}
                                </p>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col sm:flex-row gap-3 mt-8">
                            <form action="{{ url('/panier/add/' . $puzzle->id) }}" method="POST">
                                @csrf

                                <button type="submit"
                                        class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
                                    Ajouter au panier
                                </button>
                            </form>

                            <a href="{{ route('puzzles.index') }}"
                               class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-white/90 text-[#1e3b57] border border-white/50 hover:opacity-90 transition">
                                Retour aux puzzles
                            </a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>