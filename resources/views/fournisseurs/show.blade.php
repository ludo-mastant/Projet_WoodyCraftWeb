<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-5xl w-full">

            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Détail du <span class="text-[#3aa3e3]">Fournisseur</span>
                </h1>

                <p class="mt-2 text-[#1f3b57]/80">
                    Informations du fournisseur sélectionné
                </p>
            </header>

            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-8 py-8 mb-8">
                <h2 class="text-2xl font-bold text-[#1e3b57] mb-6">
                    {{ $fournisseur->nom }}
                </h2>

                <div class="space-y-4 text-[#1f3b57]">
                    <div>
                        <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                            Identifiant
                        </p>
                        <p class="text-lg font-semibold">
                            {{ $fournisseur->id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm uppercase tracking-wide text-[#1f3b57]/60 font-semibold">
                            Adresse
                        </p>
                        <p class="text-lg font-semibold">
                            {{ $fournisseur->adresse }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                       class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition">
                        Modifier
                    </a>

                    <a href="{{ route('fournisseurs.index') }}"
                       class="inline-flex justify-center items-center px-5 py-3 rounded-2xl font-semibold bg-white/90 text-[#1e3b57] border border-white/50 hover:opacity-90 transition">
                        Retour aux fournisseurs
                    </a>
                </div>
            </section>

            <section class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-8 py-8">
                <h2 class="text-2xl font-bold text-[#1e3b57] mb-6">
                    Puzzles associés
                </h2>

                @if($fournisseur->puzzles->count() === 0)
                    <p class="text-[#1f3b57]/80">
                        Aucun puzzle n’est associé à ce fournisseur.
                    </p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($fournisseur->puzzles as $puzzle)
                            <div class="bg-white/90 rounded-2xl border border-white/40 p-5 shadow">
                                <h3 class="text-lg font-bold text-[#1e3b57]">
                                    {{ $puzzle->nom }}
                                </h3>

                                <p class="text-sm text-[#1f3b57]/70 mt-2">
                                    {{ Str::limit($puzzle->description, 100) }}
                                </p>

                                <p class="font-bold text-[#1e3b57] mt-3">
                                    {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                                </p>

                                <a href="{{ route('puzzles.show', $puzzle) }}"
                                   class="inline-flex mt-4 px-4 py-2 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition">
                                    Voir le puzzle
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>