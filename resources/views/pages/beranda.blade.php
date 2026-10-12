@extends('layouts.app')

@php
    $villageName = trim((string) data_get($villageProfile ?? null, 'name', ''));
    $villageName = $villageName !== '' ? $villageName : 'Kinilow';
    $displayVillageName = preg_match('/^kelurahan\b/i', $villageName) !== 1
        ? 'Kelurahan ' . $villageName
        : $villageName;
    $villageLocation = array_values(array_filter([
        trim((string) data_get($villageProfile ?? null, 'district', '')),
        trim((string) data_get($villageProfile ?? null, 'regency', '')),
        trim((string) data_get($villageProfile ?? null, 'province', '')),
    ], static fn (string $value): bool => $value !== ''));
@endphp

@section('title', 'Beranda' . ($displayVillageName !== '' ? ' — ' . $displayVillageName : ''))

@section('content')
    {{-- Hero --}}
    <section class='kn-home-hero kn-home-hero--kinilow' aria-labelledby='hero-heading'>
        <div class='container kn-home-hero__text-wrap'>
            <div class='row align-items-center'>
                <div class='col-12 col-lg-5'>
                    <div class='kn-home-hero__content'>
                        <span class='kn-home-hero__flourish' aria-hidden='true'></span>
                        @if(count($villageLocation))
                            <p class='kn-eyebrow'>{{ implode(' · ', $villageLocation) }}</p>
                        @endif
                        <h1 id='hero-heading' class='kn-home-hero__title'>{{ $displayVillageName !== '' ? 'Selamat Datang di ' . $displayVillageName : 'Selamat Datang' }}</h1>
                        <p class='kn-home-hero__lead'>{{ data_get($villageProfile ?? null, 'short_description') ?: 'Informasi dan layanan publik dalam satu portal.' }}</p>
                        <a href='{{ route('profil') }}' class='kn-arrow-link mt-3'>Jelajahi Profil</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='container kn-home-hero__media-wrap'>
            <img class='kn-home-hero__backdrop' src='{{ asset('images/hero/kinilow-nature-heritage.webp') }}' alt='Pemandangan permukiman dan kerajinan anyaman bambu' loading='eager' fetchpriority='high' decoding='async'>
        </div>
        <svg class='kn-home-hero__wave' viewBox='0 0 1440 80' preserveAspectRatio='none' aria-hidden='true'>
            <path d='M0 47 C210 75 410 76 620 49 C830 22 1015 18 1190 40 C1290 53 1370 63 1440 50 V80 H0 Z' />
        </svg>
    </section>
    {{-- Jelajahi Kelurahan --}}
    <section class="kn-section kn-home-explore" data-reveal aria-labelledby="explore-heading">
        <div class="container">
            <x-section-header id="explore-heading" title="Jelajahi Kelurahan" eyebrow="Navigasi Cepat" />
            <div class="row g-3">
                @php
                    $exploreLinks = [
                        ['route' => 'profil', 'icon' => 'bi-book', 'label' => 'Profil', 'desc' => 'Sejarah & visi misi'],
                        ['route' => 'pemerintahan', 'icon' => 'bi-people', 'label' => 'Pemerintahan', 'desc' => 'Aparatur kelurahan'],
                        ['route' => 'informasi.index', 'icon' => 'bi-newspaper', 'label' => 'Informasi', 'desc' => 'Berita terbaru'],
                        ['route' => 'potensi.index', 'icon' => 'bi-star', 'label' => 'Potensi', 'desc' => 'Potensi unggulan'],
                        ['route' => 'fasilitas', 'icon' => 'bi-building', 'label' => 'Fasilitas', 'desc' => 'Sarana & prasarana'],
                        ['route' => 'kontak', 'icon' => 'bi-telephone', 'label' => 'Kontak', 'desc' => 'Hubungi kami'],
                    ];
                @endphp
                @foreach($exploreLinks as $link)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route($link['route']) }}" class="kn-home-link-card">
                            <span class="kn-home-link-card__icon"><i class="bi {{ $link['icon'] }}" aria-hidden="true"></i></span>
                            <div>
                                <strong>{{ $link['label'] }}</strong>
                                <small>{{ $link['desc'] }}</small>
                            </div>
                            <i class="bi bi-arrow-right kn-home-link-card__arrow" aria-hidden="true"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Berita Terkini --}}
    @if($berita->count())
        <section class="kn-section kn-section--white" data-reveal aria-labelledby="berita-heading">
            <div class="container">
                <x-section-header id="berita-heading" title="Berita Terkini" eyebrow="Informasi">
                    <a href="{{ route('informasi.index') }}" class="kn-arrow-link">Lihat semua</a>
                </x-section-header>
                <div class="row g-4">
                    @foreach($berita as $item)
                        <div class="col-md-6 col-lg-4">
                            <article class="kn-home-news-card h-100 d-flex flex-column">
                                @if($item->image)
                                    <div class="kn-static-image mb-3" style="aspect-ratio:16/10">
                                        <x-static-image :src="$item->image" :alt="$item->title" loading="lazy" />
                                    </div>
                                @endif
                                <p class="kn-home-news-card__meta">
                                    <i class="bi bi-calendar3" aria-hidden="true"></i>
                                    <time datetime="{{ $item->published_at->toDateString() }}">{{ $item->published_at->translatedFormat('d F Y') }}</time>
                                </p>
                                <h3>{{ $item->title }}</h3>
                                <p class="flex-grow-1">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                <a href="{{ route('informasi.show', $item->slug) }}" class="kn-arrow-link mt-auto">Selengkapnya</a>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    {{-- Potensi Unggulan --}}
    @if($potensi->count())
        <section class="kn-section kn-section--sand kn-home-potential" data-reveal aria-labelledby="potensi-heading">
            <div class="container">
                <x-section-header id="potensi-heading" title="Potensi Unggulan" eyebrow="Keunggulan Daerah" />
                <div class="row g-4">
                    @foreach($potensi as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="kn-home-potential-card h-100 d-flex flex-column text-center">
                                <div class="mb-3">
                                    <i class="bi bi-star-fill fs-1" style="color: var(--bs-primary)" aria-hidden="true"></i>
                                </div>
                                <h3>{{ $item->name }}</h3>
                                @if($item->description)
                                    <p class="flex-grow-1">{{ Str::limit(strip_tags($item->description), 100) }}</p>
                                @endif
                                <a href="{{ route('potensi.show', $item->slug) }}" class="kn-arrow-link justify-content-center mt-auto">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
