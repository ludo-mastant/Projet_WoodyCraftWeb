<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">

            <header class="mb-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                    Nos <span class="text-[#3aa3e3]">Puzzles</span>
                </h1>
                <p class="mt-2 text-[#1f3b57]/80">
                    Découvre tous nos puzzles en bois
                </p>
            </header>

            <section class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-4 md:px-6 py-6">
                @if($puzzles->count() === 0)
                    <div class="text-center py-12">
                        <p class="text-[#1f3b57]/80 text-lg">Aucun puzzle disponible pour le moment.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($puzzles as $puzzle)
                            <article class="group bg-white/80 rounded-3xl border border-white/40 shadow-2xl overflow-hidden transition transform hover:-translate-y-1">
                                
                                @if(!empty($puzzle->image))
                                    <img
                                        src="{{ asset('img/' . $puzzle->image) }}"
                                        alt="{{ $puzzle->nom }}"
                                        class="h-52 w-full object-cover"
                                    >
                                @else
                                    <div class="h-52 w-full bg-[#d6eafc] flex items-center justify-center text-[#1e3b57] font-semibold">
                                        Image indisponible
                                    </div>
                                @endif

                                <div class="p-5">
                                    <h2 class="text-xl font-bold text-[#1e3b57] mb-2">
                                        {{ $puzzle->nom }}
                                    </h2>

                                    <p class="text-sm text-[#1f3b57]/80 line-clamp-3">
                                        {{ $puzzle->description }}
                                    </p>

                                    @if(!empty($puzzle->prix))
                                        <div class="mt-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-[#d6eafc] text-[#1e3b57] font-semibold">
                                                {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                                            </span>
                                        </div>
                                    @endif

                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <a href="{{ route('puzzles.show', $puzzle->id) }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
                                            Voir le puzzle
                                        </a>

                                        <form action="{{ route('panier.add', $puzzle->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
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