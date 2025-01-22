<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'FlooLink') }}</title>

        <!-- SEO Meta Tags -->
        <meta name="description" content="Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.">
        <meta name="keywords" content="AES 256 encryption link generator, Encrypted URL sharing, Secure link encryption app, Decrypt protected links online, URL encryption and decryption tool, Privacy-focused link sharing, Secure URL generator with encryption, Temporary secure link generator, Expiring encrypted link sharing, Share URLs securely online, Encrypted links with expiration, Set link expiration for secure sharing, Time-sensitive encrypted links, Self-destructing encrypted links, Privacy-conscious file sharing, Secure data sharing for professionals, Encrypted link sharing for businesses, Built with VILT stack (Vue.js, Inertia.js, Laravel, Tailwind CSS), Advanced encryption link tool, Latest secure link sharing app.">
        <meta name="robots" content="index, follow">
        <meta name="author" content="FlooLink — Your Links in Disguise">
        <meta name="theme-color" content="#111827">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="FlooLink — Your Links in Disguise">
        <meta property="og:description" content="Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://floo.link">
        <meta property="og:image" content="{{ asset('images/floolink.jpg') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="FlooLink — Your Links in Disguise">
        <meta name="twitter:description" content="Teleport your URLs using advanced AES-256 encryption, transforming them into protected links ready to share.">
        <meta name="twitter:image" content="{{ asset('images/floolink.jpg') }}">

        <!-- Link Tags -->
        <link rel="canonical" href="https://floo.link">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sora:wght@100..800&display=swap" rel="stylesheet">

        <!-- Standard Favicon -->
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>

        <!-- PNG Icons for Modern Browsers -->
        <link rel="icon" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16" type="image/png"/>
        <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" type="image/png"/>
        <link rel="icon" href="{{ asset('images/favicon-96x96.png') }}" sizes="96x96" type="image/png"/>

        <!-- Apple Touch Icon -->
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}" sizes="180x180">

        <!-- Android and Chrome (Manifest) -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <!-- Microsoft Tiles -->
        <meta name="msapplication-TileColor" content="#222222">
        <meta name="msapplication-TileImage" content="{{ asset('images/mstile-150x150.png') }}">

        <!-- Safari Pinned Tab Icon -->
        <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#222222">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
