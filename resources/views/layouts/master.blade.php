<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon.ico') }}">
    <title>Tuk Tuk | Explorer</title>
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


