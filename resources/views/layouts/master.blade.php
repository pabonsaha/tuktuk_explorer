<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png') }}">
    <meta name="thumbnail" content="{{ asset('frontend-assets/images/community/image-11.png') }}">
    <title>Lisbon Tuk Tuk Explorer | Guided Tuk Tuk Tours in Lisbon</title>

    <meta name="description"
          content="Discover Lisbon’s hidden gems with Tuk Tuk tours led by expert local guides. Explore the charm, history, and culture of Portugal’s capital in a unique and memorable way. Book your unforgettable Lisbon experience today.">
    <meta name="keywords"
          content="Lisbon tuk tuk tours, Lisbon sightseeing, Portugal tours, tuk tuk rental Lisbon, guided city tours">
    <meta name="author" content="Lisbon Tuk Tuk Explorer">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ config('app.url') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="Lisbon Tuk Tuk Explorer | Guided Tuk Tuk Tours in Lisbon">
    <meta property="og:description"
          content="Discover Lisbon’s hidden gems with Tuk Tuk tours led by expert local guides. Explore the charm, history, and culture of Portugal’s capital in a unique and memorable way. Book your unforgettable Lisbon experience today.">
    <meta property="og:image" content="{{ asset('frontend-assets/images/community/image-11.png') }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="Lisbon Tuk Tuk Explorer">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('frontend-assets/images/community/image-11.png') }}">
    <meta name="twitter:title" content="Lisbon Tuk Tuk Explorer | Guided Tuk Tuk Tours in Lisbon">
    <meta name="twitter:description"
          content="Discover Lisbon’s hidden gems with Tuk Tuk tours led by expert local guides. Explore the charm, history, and culture of Portugal’s capital in a unique and memorable way. Book your unforgettable Lisbon experience today.">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans">
<!-- Header -->
@include('layouts.header')

@yield('content')

<!-- Footer -->
@include('layouts/footer')

@stack('scripts')
</body>
</html>


