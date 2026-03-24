<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-[#1e2d3d]">Connexion</h2>
        <p class="mt-2 text-sm md:text-base text-[#4f5d6b]">
            Connectez-vous pour accéder à votre compte WoodyCraft
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="'E-mail'" class="text-[#1e2d3d] font-medium" />
            <x-text-input
                id="email"
                class="block mt-2 w-full rounded-2xl border border-white/50 bg-white/80 px-4 py-3 text-[#1e2d3d] placeholder:text-gray-400 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Entrez votre adresse e-mail"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="'Mot de passe'" class="text-[#1e2d3d] font-medium" />
            <x-text-input
                id="password"
                class="block mt-2 w-full rounded-2xl border border-white/50 bg-white/80 px-4 py-3 text-[#1e2d3d] placeholder:text-gray-400 focus:border-[#1e3b57] focus:ring-[#1e3b57]"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Entrez votre mot de passe"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4 flex-wrap">
            <label for="remember_me" class="inline-flex items-center text-sm text-[#4f5d6b]">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-[#1e3b57] shadow-sm focus:ring-[#1e3b57]"
                    name="remember"
                >
                <span class="ms-2">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm text-[#1e3b57] underline hover:text-[#122536] transition"
                    href="{{ route('password.request') }}"
                >
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center rounded-2xl bg-[#1e2d3d] px-6 py-3 text-sm md:text-base font-semibold uppercase tracking-wide hover:bg-[#16212d] focus:bg-[#16212d] active:bg-[#16212d]">
                Se connecter
            </x-primary-button>
        </div>

        <div class="pt-2 text-center">
            @if (Route::has('register'))
                <p class="text-sm text-[#4f5d6b]">
                    Pas encore de compte ?
                    <a
                        href="{{ route('register') }}"
                        class="font-semibold text-[#1e3b57] underline hover:text-[#122536] transition"
                    >
                        S'inscrire
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>