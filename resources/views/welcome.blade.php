<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">

            <!-- Section d’accroche -->
            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl px-10 py-16 text-center border border-white/30">
                <img
                    src="{{ asset('img/logo_bleu.png') }}"
                    alt="WoodyCraft"
                    class="mx-auto mb-8 w-36 drop-shadow-xl"
                >

                <h1 class="text-5xl md:text-6xl font-extrabold text-[#1e3b57] tracking-tight mb-6">
                    Bienvenue chez <span class="text-[#3aa3e3]">WoodyCraft</span>
                </h1>

                <p class="text-lg md:text-xl text-[#1f3b57] leading-relaxed max-w-3xl mx-auto mb-10">
                    Les puzzles 3D en bois les plus funs, prêts à défier ton imagination ! 
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    @auth
                        <a
                            href="{{ route('paniers.index') }}"
                            class="inline-flex items-center px-8 py-3 bg-[#1e3b57] text-white text-lg font-semibold rounded-full shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-1 hover:bg-[#3aa3e3]"
                        >
                            Voir mon panier
                        </a>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="inline-flex items-center px-8 py-3 border border-[#1e3b57] text-[#1e3b57] text-lg font-semibold rounded-full shadow hover:bg-[#1e3b57] hover:text-white transition-colors"
                        >
                            Mon profil
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center px-8 py-3 bg-[#1e3b57] text-white text-lg font-semibold rounded-full shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-1 hover:bg-[#3aa3e3]"
                        >
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center px-8 py-3 border border-[#1e3b57] text-[#1e3b57] text-lg font-semibold rounded-full shadow hover:bg-[#1e3b57] hover:text-white transition-colors"
                            >
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </div>
            </section>

            @if($categories->count() > 0)
    <section class="mt-20">
        <header class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-2">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1e3b57]">
                Nos catégories phares
            </h2>
            <p class="text-sm md:text-base text-[#1f3b57]/80">
                Fais défiler pour explorer nos univers en bois.
            </p>
        </header>

        <div class="relative">
            <button
                id="prevBtn"
                type="button"
                aria-label="Précédent"
                class="hidden md:flex absolute left-0 top-1/2 z-10 -translate-y-1/2 translate-x-1/2 h-12 w-12 items-center justify-center rounded-full bg-white shadow-lg shadow-[#1e3b57]/20 border border-white/50 text-[#1e3b57] hover:bg-[#d6eafc] transition"
            >
                &#8592;
            </button>

            <button
                id="nextBtn"
                type="button"
                aria-label="Suivant"
                class="hidden md:flex absolute right-0 top-1/2 z-10 -translate-y-1/2 -translate-x-1/2 h-12 w-12 items-center justify-center rounded-full bg-white shadow-lg shadow-[#1e3b57]/20 border border-white/50 text-[#1e3b57] hover:bg-[#d6eafc] transition"
            >
                &#8594;
            </button>

            <div class="overflow-hidden">
                <div id="carousel" class="w-full flex gap-6 overflow-x-auto overflow-y-hidden scroll-smooth snap-x snap-mandatory pb-4 px-2 md:px-12">
                    @foreach($categories as $categorie)
                        <a
                            href="{{ route('categories.show', $categorie) }}"
                            class="block flex-shrink-0 w-64 snap-center"
                        >
                            <article class="h-full bg-white/90 border border-white/30 rounded-3xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 hover:bg-gradient-to-t from-[#d6eafc]/20 to-white p-6 cursor-pointer">
                                <h3 class="text-xl md:text-2xl font-semibold text-[#1e3b57] mb-2">
                                    {{ $categorie->nom }}
                                </h3>

                                <p class="text-sm md:text-base text-[#1f3b57]/90 leading-snug">
                                    {{ $categorie->description }}
                                </p>
                            </article>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('carousel');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');

            if (!carousel || !nextBtn || !prevBtn) return;

            const scrollAmount = () => {
                const card = carousel.querySelector('article');
                return card ? card.offsetWidth + 24 : 280;
            };

            nextBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: scrollAmount(),
                    behavior: 'smooth'
                });
            });

            prevBtn.addEventListener('click', () => {
                carousel.scrollBy({
                    left: -scrollAmount(),
                    behavior: 'smooth'
                });
            });
        });
    </script>

    <style>
        #carousel {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #carousel::-webkit-scrollbar {
            display: none;
        }
    </style>
</x-app-layout>
