<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WoodyCraft') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex flex-col items-center min-h-screen px-4 pt-28 pb-16 bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b]">
        <div class="max-w-6xl w-full">
            <div class="max-w-xl mx-auto bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl px-8 py-10 border border-white/30">
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}">
                        <img
                            src="{{ asset('img/logo_bleu.png') }}"
                            alt="WoodyCraft"
                            class="mx-auto mb-4 w-28 drop-shadow-xl"
                        >
                    </a>

                    <h1 class="text-3xl font-extrabold text-[#1e3b57] tracking-tight">
                        WoodyCraft
                    </h1>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>