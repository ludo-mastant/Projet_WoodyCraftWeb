<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WoodyCraft') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#f3e7d7] via-[#e7d8c5] to-[#d9c6ad] min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="inline-block">
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1e2d3d] tracking-wide">WoodyCraft</h1>
                    <p class="text-sm md:text-base text-[#4f5d6b] mt-2">
                        L’univers des puzzles 3D en bois
                    </p>
                </a>
            </div>

            <div class="bg-[#d8ccb9]/90 backdrop-blur-sm border border-white/40 rounded-[28px] shadow-[0_20px_60px_rgba(0,0,0,0.18)] p-6 md:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>