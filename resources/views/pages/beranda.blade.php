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

@section('title', 'Beranda - Kelurahan Kinilow')
@section('meta_description', 'Website resmi Kelurahan Kinilow, Kecamatan Tomohon Utara, Kota Tomohon.')

@section('content')
    <section class='kn-home-hero kn-home-hero--kinilow' aria-labelledby='hero-heading'>
        <div class='container kn-home-hero__text-wrap'>
            <div class='row align-items-center'>
                <div class='col-12 col-lg-5'>
                    <div class='kn-home-hero__content'>
                        <span class='kn-home-hero__flourish' aria-hidden='true'></span>
                        @if(count($villageLocation))
                            <p class='kn-eyebrow'>{{ implode(' ' . chr(183) . ' ', $villageLocation) }}</p>
                        @endif
                        <h1 id='hero-heading' class='kn-home-hero__title'>{{ $displayVillageName !== '' ? 'Selamat Datang di ' . $displayVillageName : 'Selamat Datang' }}</h1>
                        <p class='kn-home-hero__lead'>{{ data_get($villageProfile ?? null, 'short_description') ?: 'Informasi dan layanan publik dalam satu portal.' }}</p>
                        <a href='{{ route('tentang') }}' class='kn-arrow-link mt-3'>Tentang Kinilow</a>
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

    <section class="kn-home-stats" aria-label="Sekilas Kelurahan Kinilow">
        <div class="container">
            <div class="kn-home-stats__grid">
                <article class="kn-home-stat" data-home-stat>
                    <span class="kn-home-stat__icon"><i class="bi bi-map" aria-hidden="true"></i></span>
                    <span class="kn-home-stat__value" data-countup="6" data-countup-decimals="2" data-countup-suffix=" km&#178;">6,00 km&sup2;</span>
                    <span class="kn-home-stat__label">Luas wilayah</span>
                </article>
                <article class="kn-home-stat" data-home-stat>
                    <span class="kn-home-stat__icon"><i class="bi bi-houses" aria-hidden="true"></i></span>
                    <span class="kn-home-stat__value" data-countup="7" data-countup-suffix="">7</span>
                    <span class="kn-home-stat__label">Lingkungan</span>
                </article>
                <article class="kn-home-stat" data-home-stat>
                    <span class="kn-home-stat__icon"><i class="bi bi-thermometer-snow" aria-hidden="true"></i></span>
                    <span class="kn-home-stat__value" data-countup="700" data-countup-prefix="&plusmn; " data-countup-suffix=" mdpl">&plusmn; 700 mdpl</span>
                    <span class="kn-home-stat__label">Ketinggian rata-rata</span>
                </article>
                <article class="kn-home-stat" data-home-stat>
                    <span class="kn-home-stat__icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                    <span class="kn-home-stat__value" data-countup="2459" data-countup-suffix="">2.459</span>
                    <span class="kn-home-stat__label">Jiwa penduduk (BPS)</span>
                </article>
            </div>
        </div>
    </section>

    <section id="gambaran-umum" class="kn-section kn-section--white kn-home-overview" data-reveal aria-labelledby="kinilow-overview-heading">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <x-section-header id="kinilow-overview-heading" title="Kenali lebih dekat Kelurahan Kinilow" eyebrow="Gambaran Umum" />
                    <p class="kn-home-overview__copy">Kinilow berada di dataran tinggi antara Gunung Lokon dan Gunung Mahawu. Berdasarkan data BPS, Kinilow merupakan kelurahan terluas di Kecamatan Tomohon Utara (6,00 km&sup2;), didukung potensi wisata alam seperti Gunung Lokon dan Gunung Empung, Air Terjun Kanderawatu, dan Waruga; sarana akomodasi hotel; serta sentra kerajinan anyaman bambu dan UMKM yang bertumbuh.</p>
                    <a href="{{ route('tentang') }}" class="kn-home-text-link">Baca Selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                </div>
                <div class="col-lg-6">
                    <div class="kn-home-collage" role="group" aria-label="Alam dan kerajinan Kelurahan Kinilow">
                        <figure class="kn-home-collage__waterfall">
                            <div class="kn-home-photo-frame kn-home-photo-frame--portrait">
                                <img src="{{ asset('images/patterns/air-terjun.jpeg') }}" alt="Air Terjun Kanderawatu yang dikelilingi hutan hijau" loading="lazy" decoding="async">
                            </div>
                            <figcaption>Air Terjun Kanderawatu</figcaption>
                        </figure>
                        <figure class="kn-home-collage__craft">
                            <div class="kn-home-photo-frame kn-home-photo-frame--square">
                                <img src="{{ asset('images/patterns/anyaman.png') }}" alt="Anyaman bambu Kinilow" loading="lazy" decoding="async">
                            </div>
                            <figcaption>Anyaman bambu Kinilow</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="kn-section kn-home-explore" data-reveal aria-labelledby="explore-heading">
        <div class="container">
            <x-section-header id="explore-heading" title="Jelajahi Kelurahan" eyebrow="Navigasi Cepat" />
            <div class="row g-3">
                @php
                    $exploreLinks = [
                        ['route' => 'tentang', 'icon' => 'bi-book', 'label' => 'Tentang Kinilow', 'desc' => 'Gambaran umum & pemerintahan'],
                        ['route' => 'informasi.index', 'icon' => 'bi-newspaper', 'label' => 'Layanan Publik', 'desc' => 'Berita dan layanan warga'],
                        ['route' => 'galeri', 'icon' => 'bi-images', 'label' => 'Galeri', 'desc' => 'Dokumentasi Kinilow'],
                        ['route' => 'fasilitas', 'icon' => 'bi-building', 'label' => 'Fasilitas', 'desc' => 'Sarana dan prasarana'],
                        ['route' => 'anggota-kkt', 'icon' => 'bi-people', 'label' => 'Anggota KKT', 'desc' => 'Tim KKT Kinilow'],
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

    <section class="kn-home-mapalus" data-reveal aria-label="Nilai kebersamaan masyarakat Kinilow">
        <div class="container">
            <div class="kn-home-mapalus__inner">
                <span class="kn-home-mapalus__mark" aria-hidden="true"><i class="bi bi-flower1"></i></span>
                <div>
                    <p class="kn-eyebrow">Semangat Mapalus</p>
                    <blockquote>&ldquo;Bekerja bersama, menjaga kampung, dan merawat harapan untuk Kinilow.&rdquo;</blockquote>
                </div>
                <span class="kn-home-mapalus__caption">Kebersamaan adalah kekuatan warga.</span>
            </div>
        </div>
    </section>

    @if($berita->count())
        <section class="kn-section kn-section--white kn-home-latest" data-reveal aria-labelledby="berita-heading">
            <div class="container">
                <x-section-header id="berita-heading" title="Berita Terkini" eyebrow="Layanan Publik">
                    <a href="{{ route('informasi.index') }}" class="kn-home-text-link">Lihat semua <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
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
@endsection
