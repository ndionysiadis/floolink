<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'FlooLink') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sora:wght@100..800&display=swap"
          rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" type="image/png"/>
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Microsoft Tiles -->
    <meta name="msapplication-TileColor" content="#222222">
    <meta name="msapplication-TileImage" content="{{ asset('images/mstile-150x150.png') }}">

    <!-- Safari Pinned Tab Icon -->
    <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#222222">

    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased h-full">
<main class="relative isolate min-h-full">
    <video src="/images/404-video-bg.mp4" type="video/mp4" autoplay muted playsinline poster="/images/404-bg.jpg" class="absolute inset-0 -z-10 w-full h-full object-cover object-top">
    </video>
    <div class="flex flex-col items-center justify-center h-screen gap-4">
        <h2 class="text-base/8 font-semibold text-white">404</h2>
        <h1 class="text-balance text-5xl font-semibold tracking-tight text-white sm:text-7xl">Oh dear. Are you lost?</h1>
        <p class="text-pretty text-2xl font-medium text-white">This FlooLink has fizzled out—time’s up!</p>

        <a href="{{ route('index') }}" aria-label="Create a new link" class="relative group">
            <button class="relative inline-block p-px font-semibold leading-6 text-white bg-gray-900 shadow-2xl cursor-pointer rounded-2xl shadow-emerald-900 transition-all duration-300 ease-in-out hover:scale-105 active:scale-95 hover:shadow-emerald-600">
                <span class="absolute inset-0 rounded-2xl bg-linear-to-t from-emerald-400 to-emerald-700 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                <span class="relative z-10 block px-6 py-3 rounded-2xl bg-gray-900">
                    <div class="relative z-10 flex items-center">
                        <span class="transition-all duration-500 group-hover:scale-105 group-hover:text-emerald-300">
                            Create a new one
                        </span>
                    </div>
                </span>
            </button>
        </a>
    </div>
</main>
</body>
</html>
