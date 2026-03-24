<x-app-layout>
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">
            <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl px-6 md:px-10 py-10 border border-white/30">
                <div class="text-center mb-10">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3b57] tracking-tight">
                        Mon profil
                    </h1>
                    <p class="text-[#1f3b57]/80 mt-3">
                        Gère tes informations personnelles et la sécurité de ton compte.
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="bg-white/90 border border-white/30 rounded-3xl shadow-lg p-6 md:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="bg-white/90 border border-white/30 rounded-3xl shadow-lg p-6 md:p-8">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="bg-white/90 border border-white/30 rounded-3xl shadow-lg p-6 md:p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>