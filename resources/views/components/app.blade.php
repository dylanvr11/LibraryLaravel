<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
        Pasarle nombre el app blade
        <title>{{ $title }}</title>
    --}}
    <title>{{ $title ?? 'Biblioteca' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    {{-- Menu --}}
    {{-- <x-menu/> otra forma de importar--}}
    {{-- @include('components.menu') una forma --}}
    <x-menu/>
    {{-- Content --}}
        <main id="app">
            <div class="container mt-5">
                <x-alerts/>
            </div>
            {{$slot}}
        </main>
</body>
</html>
