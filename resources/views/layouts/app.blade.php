<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kelurahan Kinilow')</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Kelurahan Kinilow, Kecamatan Tomohon Utara, Kota Tomohon')">
    <meta property="og:title" content="@yield('og_title', 'Website Kelurahan Kinilow')">
    <meta property="og:description" content="@yield('og_description', 'Website resmi Kelurahan Kinilow')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100" style="--kn-batik-pattern: url('/images/patterns/batik-kinilow.webp')">
    <a href="#konten-utama" class="kn-skip-link">Langsung ke konten</a>

    @include('partials.navbar')

    <main id="konten-utama" class="kn-main" role="main">
        @yield('content')
    </main>

    @unless(request()->routeIs('beranda'))
        <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>
    @endunless

    @include('partials.footer')
</body>
</html>
