<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-b from-[#f7ede2] via-[#e4d7c3] to-[#c9b39b] min-h-screen">
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-10">
        <a href="{{ route('home') }}" class="mb-6">
            <img src="{{ asset('img/logo_bleu.png') }}" alt="WoodyCraft" class="w-24 drop-shadow-xl">
        </a>

        <div class="w-full max-w-xl bg-white/85 backdrop-blur-lg shadow-2xl rounded-3xl p-8 border border-white/40">
            {{ $slot }}
        </div>
    </div>
</body>
</html>