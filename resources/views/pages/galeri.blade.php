@extends('layouts.app')

@section('title', 'Galeri | Kelurahan Kinilow')
@section('meta_description', 'Dokumentasi kegiatan dan aktivitas bersama masyarakat di Kelurahan Kinilow.')

@section('content')
    <x-page-header
        title="Galeri"
        subtitle="Dokumentasi Kelurahan Kinilow"
        variant="gallery"
        intro="Dokumentasi kegiatan dan aktivitas bersama masyarakat Kelurahan Kinilow."
    />

    <section class="kn-section kn-gallery kn-gallery--documentation" data-reveal>
        <div class="container">
            <x-section-header
                eyebrow="Catatan perjalanan"
                title="Dokumentasi Kegiatan"
                lead="Foto kegiatan dan aktivitas bersama masyarakat."
            />

            @if ($proker->isNotEmpty())
                <div class="row g-3 g-lg-4">
                    @foreach ($proker as $item)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="kn-gallery-proker-card">
                                <span class="kn-gallery-proker-card__image">
                                    <img
                                        src="{{ asset($item['cover']['thumb']) }}"
                                        alt="{{ $item['cover']['alt'] }}"
                                        width="{{ $item['cover']['width'] }}"
                                        height="{{ $item['cover']['height'] }}"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </span>
                                <span class="kn-gallery-proker-card__body">
                                    <span class="kn-gallery-proker-card__title">{{ $item['judul'] }}</span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <x-empty-state
                    message="Foto kegiatan akan segera ditambahkan."
                    icon="bi-camera"
                />
            @endif
        </div>
    </section>
@endsection