<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">

            {{-- En-tête --}}
            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Gestion des <span class="text-[#3aa3e3]">Fournisseurs</span>
                </h1>

                <p class="mt-2 text-[#1f3b57]/80">
                    Ajoute, modifie ou supprime les fournisseurs des puzzles
                </p>
            </header>

            {{-- Messages --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 text-green-800 rounded-2xl px-5 py-4 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 text-red-800 rounded-2xl px-5 py-4 border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Barre d'action --}}
            <section class="mb-6 bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-8 py-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[#1e3b57]">
                            Liste des fournisseurs
                        </h2>
                        <p class="text-sm text-[#1f3b57]/70">
                            Total : {{ $fournisseurs->count() }} fournisseur{{ $fournisseurs->count() > 1 ? 's' : '' }}
                        </p>
                    </div>

                    <a href="{{ route('fournisseurs.create') }}"
                       class="inline-flex items-center justify-center px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
                        Ajouter un fournisseur
                    </a>
                </div>
            </section>

            {{-- Liste --}}
            <section class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-4 md:px-6 py-6">
                @if($fournisseurs->count() === 0)
                    <div class="text-center py-12">
                        <p class="text-[#1f3b57]/80 mb-4">
                            Aucun fournisseur n’a encore été ajouté.
                        </p>

                        <a href="{{ route('fournisseurs.create') }}"
                           class="inline-flex items-center px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition">
                            Créer le premier fournisseur
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="text-left text-[#1e3b57] border-b border-[#1e3b57]/20">
                                    <th class="py-3 px-4">ID</th>
                                    <th class="py-3 px-4">Nom</th>
                                    <th class="py-3 px-4">Adresse</th>
                                    <th class="py-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($fournisseurs as $fournisseur)
                                    <tr class="border-b border-white/60 text-[#1f3b57]">
                                        <td class="py-4 px-4">
                                            {{ $fournisseur->id }}
                                        </td>

                                        <td class="py-4 px-4 font-semibold">
                                            {{ $fournisseur->nom }}
                                        </td>

                                        <td class="py-4 px-4">
                                            {{ $fournisseur->adresse }}
                                        </td>

                                        <td class="py-4 px-4">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                                                   class="inline-flex items-center px-4 py-2 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition">
                                                    Modifier
                                                </a>

                                                <form action="{{ route('fournisseurs.destroy', $fournisseur) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Voulez-vous vraiment supprimer ce fournisseur ?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 rounded-2xl font-semibold bg-red-600 text-white hover:opacity-90 transition">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>