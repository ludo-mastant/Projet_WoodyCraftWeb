{{-- resources/views/categories/show.blade.php --}}
<x-app-layout>
  <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
    <div class="max-w-6xl w-full">

      @php
        $puzzles = $puzzles ?? collect();
        $isPaginator = $puzzles instanceof \Illuminate\Pagination\AbstractPaginator;

        $count = $isPaginator
          ? $puzzles->total()
          : (is_countable($puzzles) ? count($puzzles) : 0);

        $loopItems = $isPaginator
          ? $puzzles
          : (is_iterable($puzzles) ? $puzzles : collect());
      @endphp

      {{-- En-tête --}}
      <header class="mb-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
          {{ $category->name ?? $category->nom }}
          <span class="text-[#3aa3e3]">/ Catégorie</span>
        </h1>

        <div class="mt-3">
          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-[#d6eafc] text-[#1e3b57]">
            {{ $count }} puzzle{{ $count > 1 ? 's' : '' }}
          </span>
        </div>

        @if(!empty($category->description))
          <p class="mt-3 text-[#1f3b57]/80 max-w-3xl mx-auto">{{ $category->description }}</p>
        @endif
      </header>

      {{-- Image de catégorie (optionnelle) --}}
      @if(!empty($category->image))
        <div class="mb-6 overflow-hidden rounded-3xl border border-white/30 shadow-2xl">
          <img src="{{ $category->image }}" alt="{{ $category->name ?? $category->nom }}" class="w-full h-64 object-cover">
        </div>
      @endif

      {{-- Filtres / Tri --}}
      <section class="mb-6 bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-6 md:px-8 py-5">
        <form method="GET" action="{{ route('categories.show', $category->id) }}" class="grid gap-3 md:grid-cols-3">
          <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Rechercher un puzzle…"
            class="px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] outline-none focus:ring-2 focus:ring-[#3aa3e3]/50">

          <select name="sort"
            class="px-4 py-3 rounded-2xl border border-white/50 bg-white/90 text-[#1e3b57] focus:ring-2 focus:ring-[#3aa3e3]/50">
            <option value="">Tri par défaut</option>
            <option value="price_asc"  @selected(request('sort')==='price_asc')>Prix croissant</option>
            <option value="price_desc" @selected(request('sort')==='price_desc')>Prix décroissant</option>
            <option value="name_asc"   @selected(request('sort')==='name_asc')>Nom A→Z</option>
            <option value="name_desc"  @selected(request('sort')==='name_desc')>Nom Z→A</option>
            <option value="newest"     @selected(request('sort')==='newest')>Nouveautés</option>
          </select>

          <button class="inline-flex justify-center items-center gap-2 px-5 py-3 rounded-2xl font-semibold bg-[#1e3b57] text-white hover:opacity-90 transition active:scale-95">
            Appliquer
          </button>
        </form>
      </section>

      {{-- Liste des puzzles --}}
      <section class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/30 px-4 md:px-6 py-6">
        @if($count === 0)
          <div class="text-center py-12">
            <p class="text-[#1f3b57]/80 text-lg">Aucun puzzle à afficher pour le moment.</p>
            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center gap-2 mt-6 px-6 py-3 rounded-2xl font-semibold bg-white/80 text-[#1e3b57] border border-white/50 shadow hover:bg-white transition active:scale-95">
              Retour aux catégories
            </a>
          </div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($loopItems as $puzzle)
              @isset($puzzle)
              <article class="group bg-white/80 rounded-3xl border border-white/40 shadow-2xl overflow-hidden transition transform hover:-translate-y-1">
                {{-- Image puzzle (résolution robuste du chemin) --}}
                @php
                  $src = $puzzle->image ?? $puzzle->image_path ?? null;
                  $imgUrl = null;

                  if ($src) {
                      if (\Illuminate\Support\Str::startsWith($src, ['http://','https://','data:'])) {
                          $imgUrl = $src;
                      } elseif (\Illuminate\Support\Str::startsWith($src, ['storage/','/'])) {
                          $imgUrl = asset($src);
                      } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($src)) {
                          $imgUrl = asset('storage/'.$src);
                      } else {
                          $imgUrl = asset('images/'.$src);
                      }
                  }
                @endphp

                @if($imgUrl)
                  <a href="{{ route('puzzles.show', $puzzle->id) }}">
                    <img src="{{ $imgUrl }}" alt="{{ $puzzle->name ?? $puzzle->nom }}" class="h-48 w-full object-cover">
                  </a>
                @else
                  <img src="{{ asset('images/placeholder.jpg') }}" alt="Image indisponible" class="h-48 w-full object-cover opacity-60">
                @endif

                <div class="p-5">
                  <a href="{{ route('puzzles.show', $puzzle->id) }}" class="block">
                    <h3 class="text-lg font-bold text-[#1e3b57] group-hover:underline">
                      {{ $puzzle->name ?? $puzzle->nom }}
                    </h3>
                  </a>

                  @php
                    $desc = $puzzle->short_description ?? $puzzle->description ?? null;
                  @endphp
                  @isset($desc)
                    <p class="mt-1 text-sm text-[#1f3b57]/80 line-clamp-2">
                      {{ \Illuminate\Support\Str::limit($desc, 120) }}
                    </p>
                  @endisset

                  <div class="mt-3 flex items-center justify-between">
                    <span class="text-xl font-extrabold text-[#1e3b57]">
                      @isset($puzzle->price)
                        {{ number_format($puzzle->price, 2, ',', ' ') }} €
                      @elseif(isset($puzzle->prix))
                        {{ number_format($puzzle->prix, 2, ',', ' ') }} €
                      @else
                        —
                      @endisset
                    </span>
                    <form method="POST" action="{{ route('panier.add', $puzzle->id) }}">
                      @csrf
                      <button
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl font-semibold bg-[#3aa3e3] text-white hover:opacity-90 transition active:scale-95">
                        Ajouter
                      </button>
                    </form>
                  </div>
                </div>
              </article>
              @endisset
            @endforeach
          </div>

          {{-- Pagination si Paginator --}}
          @if($isPaginator)
            <div class="mt-8">
              {{ $puzzles->withQueryString()->links() }}
            </div>
          @endif
        @endif
      </section>

      {{-- Lien retour --}}
      <div class="mt-6">
        <a href="{{ route('categories.index') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl font-semibold bg-white/80 text-[#1e3b57] border border-white/50 shadow hover:bg-white transition active:scale-95">
          ← Toutes les catégories
        </a>
      </div>

    </div>
  </div>
</x-app-layout>
