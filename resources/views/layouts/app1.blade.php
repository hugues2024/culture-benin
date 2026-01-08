<!DOCTYPE html>
<html lang="fr">
<head>
    @include('partials.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Favicons -->
        <link rel="icon" type="image/png" href="{{asset('img/favicon/favicon-96x96.png')}}" sizes="96x96/>"/>

    <link rel="icon" type="image/svg+xml" href="{{asset('img/favicon/favicon.svg')}}" />

    <link rel="shortcut icon" href="{{asset('img/favicon/favicon.ico')}}" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-touch-icon.png')}}" />

    <link rel="manifest" href="{{asset('/site.webmanifest')}}" />
</head>
<body>
    @include('partials.nav')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.foot')
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>