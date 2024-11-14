<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-w-full overflow-visible prose">
    {{-- this is where mobile nav goes --}}
    @include('layouts.mobile-navigation')
    <div class="flex flex-row">
        @include('layouts.navigation')
        <div class="px-6 grow sm:px-12 sm:pt-36">
            <main class="max-w-3xl mx-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
