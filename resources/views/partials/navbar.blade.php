@php
    $navLinks = [
        ['route' => 'beranda', 'label' => 'Beranda'],
        ['route' => 'tentang', 'label' => 'Tentang Kinilow'],
        ['route' => 'informasi.index', 'label' => 'Layanan Publik'],
        ['route' => 'galeri', 'label' => 'Galeri'],
        ['route' => 'fasilitas', 'label' => 'Fasilitas'],
        ['route' => 'anggota-kkt', 'label' => 'Anggota KKT'],
        ['route' => 'kontak', 'label' => 'Kontak'],
    ];
@endphp
<header>
    <nav class="kn-site-nav navbar navbar-expand-xl sticky-top {{ request()->routeIs('beranda') ? 'kn-site-nav--home' : '' }}" aria-label="Navigasi utama">
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
                        @php
                            $isActive = $link['route'] === 'informasi.index'
                                ? request()->routeIs('informasi.*')
                                : request()->routeIs($link['route']);
                        @endphp
                        <li class="nav-item">
                            <a class="kn-nav-link nav-link {{ $isActive ? 'active' : '' }}"
                               @if($isActive) aria-current="page" @endif
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
