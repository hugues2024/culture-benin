<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicons -->
        <link rel="icon" type="image/png" href="{{asset('img/favicon/favicon-96x96.png')}}" sizes="96x96/>"/>

        <link rel="icon" type="image/svg+xml" href="{{asset('img/favicon/favicon.svg')}}" />

        <link rel="shortcut icon" href="{{asset('img/favicon/favicon.ico')}}" />

        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-touch-icon.png')}}" />

        <link rel="manifest" href="{{asset('/site.webmanifest')}}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
<style>
    /* Couleur de sélection pour Chrome, Firefox, Safari et Edge */
    ::selection {
        background-color: rgba(0, 135, 81, 0.25); /* Vert bénin avec 25% d'opacité */
        color: #008751; /* Le texte lui-même devient vert foncé */
    }

    /* Pour Firefox (version spécifique) */
    ::-moz-selection {
        background-color: rgba(0, 135, 81, 0.25);
        color: #008751;
    }
</style>