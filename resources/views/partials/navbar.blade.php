@php
    $navLinks = [
        ['route' => 'beranda', 'label' => 'Beranda'],
        ['route' => 'profil', 'label' => 'Profil'],
        ['route' => 'pemerintahan', 'label' => 'Pemerintahan'],
        ['route' => 'informasi.index', 'label' => 'Informasi'],
        ['route' => 'potensi.index', 'label' => 'Potensi'],
        ['route' => 'galeri', 'label' => 'Galeri'],
        ['route' => 'fasilitas', 'label' => 'Fasilitas'],
        ['route' => 'kontak', 'label' => 'Kontak'],
    ];
@endphp
<header>
    <nav class="kn-site-nav navbar navbar-expand-lg sticky-top" aria-label="Navigasi utama">
        <div class="container d-flex align-items-center">
            <a class="kn-wordmark" href="{{ route('beranda') }}">
                @if (file_exists(public_path('images/patterns/logo-tomohon.png')))
                    <img class="kn-wordmark__logo" src="{{ asset('images/patterns/logo-tomohon.png') }}" alt="" aria-hidden="true" width="40" height="40" decoding="async">
                @else
                    <i class="bi bi-building fs-4" aria-hidden="true"></i>
                @endif
                <span>Kelurahan<br>Kinilow</span>
            </a>
            <button class="kn-nav-toggle navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse kn-batik-menu" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @foreach ($navLinks as $link)
                        <li class="nav-item">
                            <a class="kn-nav-link nav-link {{ request()->routeIs($link['route'] . '*') ? 'active' : '' }}"
                               @if(request()->routeIs($link['route'] . '*')) aria-current="page" @endif
                               href="{{ route($link['route']) }}">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>