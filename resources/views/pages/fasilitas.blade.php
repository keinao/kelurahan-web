@extends('layouts.app')

@section('title', 'Fasilitas - Kelurahan Kinilow')
@section('meta_description', 'Daftar penginapan, kuliner, tempat ibadah, dan tempat wisata di Kelurahan Kinilow.')
@section('og_title', 'Fasilitas - Kelurahan Kinilow')
@section('og_description', 'Lihat fasilitas dan tempat di Kelurahan Kinilow beserta tautan Google Maps.')

@section('content')
    <x-page-header title="Fasilitas" subtitle="Sarana dan Prasarana" />

    <section class="kn-section kn-section--white" aria-label="Daftar fasilitas Kelurahan Kinilow">
        <div class="container">
            @if($fasilitas->count())
                <nav class="kn-facility-filters" aria-label="Filter kategori fasilitas">
                    <button type="button" class="kn-facility-filter is-active" data-facility-filter="all" aria-pressed="true">Semua</button>
                    @foreach(['penginapan' => 'Penginapan', 'kuliner' => 'Kuliner', 'wisata-alam' => 'Wisata Alam', 'ibadah' => 'Tempat Ibadah'] as $key => $label)
                        <button type="button" class="kn-facility-filter" data-facility-filter="{{ $key }}" aria-pressed="false">{{ $label }}</button>
                    @endforeach
                </nav>
                <div class="kn-facility-grid" id="facility-grid">
                    @foreach($fasilitas as $index => $item)
                        <div data-facility-card data-category="{{ $item['category_key'] }}">
                            <article class="kn-facility-card h-100">
                                @if(!empty($item['photos']))
                                    <div class="kn-facility-card__cover">
                                        <img
                                            src="{{ asset($item['photos'][0]['thumb']) }}"
                                            alt="{{ $item['photos'][0]['alt'] }}"
                                            width="{{ $item['photos'][0]['width'] }}"
                                            height="{{ $item['photos'][0]['height'] }}"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                @else
                                    <div class="kn-facility-card__placeholder" aria-label="Foto {{ $item['name'] }} belum tersedia">
                                        <i class="bi bi-image" aria-hidden="true"></i>
                                        <span>Foto belum tersedia</span>
                                    </div>
                                @endif
                                <div class="kn-facility-card__body">
                                    <div class="kn-facility-card__heading">
                                        <div>
                                            <h2>{{ $item['name'] }}</h2>
                                            @if($item['subtitle'])
                                                <p class="kn-facility-card__subtitle">{{ $item['subtitle'] }}</p>
                                            @endif
                                        </div>
                                        @if($item['category'])
                                            <span class="kn-facility-card__category">{{ $item['category'] }}</span>
                                        @endif
                                    </div>
                                    @if($item['description'])
                                        <p class="kn-facility-card__description">{{ $item['description'] }}</p>
                                    @endif
                                    @if($item['map_url'])
                                        <a href="{{ $item['map_url'] }}" target="_blank" rel="noopener noreferrer" class="kn-facility-card__map">
                                            <i class="bi bi-map" aria-hidden="true"></i>
                                            Lihat di Google Maps
                                        </a>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <p class="kn-facility-empty-filter" hidden>Tidak ada fasilitas pada kategori ini.</p>

                <script>
                    (() => {
                        const filters = document.querySelectorAll('[data-facility-filter]');
                        const cards = document.querySelectorAll('[data-facility-card]');
                        const empty = document.querySelector('.kn-facility-empty-filter');
                        filters.forEach((filter) => filter.addEventListener('click', () => {
                            const selected = filter.dataset.facilityFilter;
                            let visible = 0;
                            filters.forEach((button) => {
                                const active = button === filter;
                                button.classList.toggle('is-active', active);
                                button.setAttribute('aria-pressed', String(active));
                            });
                            cards.forEach((card) => {
                                const show = selected === 'all' || card.dataset.category === selected;
                                card.hidden = !show;
                                if (show) visible++;
                            });
                            if (empty) empty.hidden = visible !== 0;
                        }));
                    })();
                </script>
            @else
                <x-empty-state message="Informasi fasilitas belum tersedia." icon="bi-building" />
            @endif
        </div>
    </section>
@endsection
