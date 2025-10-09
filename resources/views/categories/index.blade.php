<x-app-layout>
  <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
    <div class="max-w-6xl w-full">

      {{-- En-tête --}}
      <header class="mb-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
          Nos <span class="text-[#3aa3e3]">Catégories</span>
        </h1>
        <p class="mt-2 text-[#1f3b57]/80">Parcours les univers et trouve ton prochain puzzle 🧩</p>
      </header>

      {{-- Barre d’outils (recherche + tri) --}}
      <section class="mb-6 bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-8 py-5">
        <form method="GET" action="{{ route('categories.index') }}" class="flex flex-col md:flex-row gap-3 md:items-center">
          <div class="flex-1">
            <input
              type="text"
              name="q"
              value="{{ request('q') }}"
              placeholder="Rechercher une catégorie…"
              class="w-full px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] outline-none focus:ring-2 focus:ring-[#3aa3e3]/50"
            >
          </div>
          <div class="flex items-center gap-3">
            <select name="sort"
              class="px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] focus:ring-2 focus:ring-[#3aa3e3]/50">
              <option value="">Tri par défaut</option>
              <option value="name_asc"  @selected(request('sort')==='name_asc')>Nom A→Z</option>
              <option value="name_desc" @selected(request('sort')==='name_desc')>Nom Z→A</option>
              <option value="count_desc" @selected(request('sort')==='count_desc')>Plus de produits</option>
              <option value="count_asc"  @selected(request('sort')==='count_asc')>Moins de produits</option>
            </select>
            <button class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
              Appliquer
            </button>
          </div>
        </form>
      </section>

      {{-- Grille de catégories --}}
      <section class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-4 md:px-6 py-6">
        @if(($categories->count() ?? count($categories ?? [])) === 0)
          <div class="text-center py-12">
            <p class="text-[#1f3b57]/80 text-lg">Aucune catégorie ne correspond à ta recherche.</p>
            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center gap-2 mt-6 px-6 py-3 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
              Réinitialiser les filtres
            </a>
          </div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
              <article class="group bg-white/80 rounded-3xl border border-white/40 shadow-2xl overflow-hidden transition transform hover:-translate-y-1">
                @if(!empty($category->image))
                  <img src="{{ $category->image }}" alt="{{ $category->name ?? $category->nom }}"
                       class="h-44 w-full object-cover">
                @endif

                <div class="p-5">
                  <h2 class="text-xl font-bold text-[#1e3b57] mb-1">
                    {{ $category->name ?? $category->nom }}
                  </h2>
                  @php
                    $count = $category->products_count ?? $category->puzzles_count ?? $category->products?->count();
                  @endphp
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-[#d6eafc] text-[#1e3b57]">
                    {{ $count ?? 0 }} produit{{ ($count ?? 0) > 1 ? 's' : '' }}
                  </span>

                  @if(!empty($category->description))
                    <p class="mt-3 text-sm text-[#1f3b57]/80 line-clamp-3">{{ $category->description }}</p>
                  @endif

                  <div class="mt-4 flex gap-2">
                    <a href="{{ route('categories.show', $category->id) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
                      Voir la catégorie
                    </a>
                    <a href="{{ route('puzzles.index', ['category' => $category->id]) }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl font-semibold bg-white/80 text-[#1e3b57] border border-white/50 shadow hover:bg-white transition active:scale-95">
                      Parcourir les produits
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>

          {{-- Pagination (si c’est un LengthAwarePaginator) --}}
          @if(method_exists($categories, 'links'))
            <div class="mt-8">
              {{ $categories->withQueryString()->links() }}
            </div>
          @endif
        @endif
      </section>

    </div>
  </div>
</x-app-layout>
