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
                <div class="row g-4" id="facility-grid">
                    @foreach($fasilitas as $index => $item)
                        <div class="col-12 col-md-6 col-xl-4" data-facility-card data-category="{{ $item['category_key'] }}">
                            <article class="kn-facility-card h-100">
                                @if(!empty($item['photos']))
                                    <button
                                        class="kn-facility-card__cover"
                                        type="button"
                                        data-facility-index="{{ $index }}"
                                        aria-label="Lihat foto {{ $item['name'] }}"
                                    >
                                        <img
                                            src="{{ asset($item['photos'][0]['thumb']) }}"
                                            alt="{{ $item['photos'][0]['alt'] }}"
                                            width="{{ $item['photos'][0]['width'] }}"
                                            height="{{ $item['photos'][0]['height'] }}"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                        @if(count($item['photos']) > 1)
                                            <span class="kn-facility-card__photo-count">{{ count($item['photos']) }} foto</span>
                                        @endif
                                    </button>
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
            @else
                <x-empty-state message="Informasi fasilitas belum tersedia." icon="bi-building" />
            @endif
        </div>
    </section>

    @if($fasilitas->contains(fn ($item) => !empty($item['photos'])))
        <dialog class="kn-facility-lightbox" id="facility-lightbox" aria-labelledby="facility-lightbox-title">
            <div class="kn-facility-lightbox__header">
                <div>
                    <h2 id="facility-lightbox-title"></h2>
                    <p id="facility-lightbox-count" aria-live="polite"></p>
                </div>
                <button class="kn-facility-lightbox__close" type="button" aria-label="Tutup foto">&times;</button>
            </div>
            <div class="kn-facility-lightbox__content">
                <button class="kn-facility-lightbox__nav" type="button" data-facility-direction="previous" aria-label="Foto sebelumnya">&#8592;</button>
                <img class="kn-facility-lightbox__image" alt="" width="1600" height="900">
                <button class="kn-facility-lightbox__nav" type="button" data-facility-direction="next" aria-label="Foto berikutnya">&#8594;</button>
            </div>
        </dialog>
        <script>
            (() => {
                const items = @json($fasilitas->values());
                const assetBase = @json(asset(''));
                const dialog = document.getElementById('facility-lightbox');
                const image = dialog.querySelector('.kn-facility-lightbox__image');
                const title = dialog.querySelector('#facility-lightbox-title');
                const count = dialog.querySelector('#facility-lightbox-count');
                const closeButton = dialog.querySelector('.kn-facility-lightbox__close');
                const navButtons = dialog.querySelectorAll('[data-facility-direction]');
                let activeFacility = 0;
                let activePhoto = 0;
                let opener = null;
                const photoUrl = (path) => new URL(path, assetBase.endsWith('/') ? assetBase : `${assetBase}/`).href;
                const showPhoto = () => {
                    const item = items[activeFacility];
                    const photos = item.photos;
                    const photo = photos[activePhoto];
                    title.textContent = item.name;
                    count.textContent = `${activePhoto + 1} / ${photos.length}`;
                    image.src = photoUrl(photo.file);
                    image.alt = photo.alt;
                    image.width = photo.full_width;
                    image.height = photo.full_height;
                    navButtons.forEach((button) => { button.disabled = photos.length < 2; });
                };
                document.querySelectorAll('[data-facility-index]').forEach((button) => {
                    button.addEventListener('click', () => {
                        activeFacility = Number(button.dataset.facilityIndex);
                        activePhoto = 0;
                        opener = button;
                        showPhoto();
                        dialog.showModal();
                        closeButton.focus();
                    });
                });
                closeButton.addEventListener('click', () => dialog.close());
                dialog.addEventListener('click', (event) => { if (event.target === dialog) dialog.close(); });
                dialog.addEventListener('close', () => opener?.focus());
                const move = (direction) => {
                    const length = items[activeFacility].photos.length;
                    activePhoto = (activePhoto + direction + length) % length;
                    showPhoto();
                };
                navButtons.forEach((button) => button.addEventListener('click', () => move(button.dataset.facilityDirection === 'next' ? 1 : -1)));
                dialog.addEventListener('keydown', (event) => {
                    if (!['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
                    event.preventDefault();
                    move(event.key === 'ArrowRight' ? 1 : -1);
                });
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
                    empty.hidden = visible !== 0;
                }));
            })();
        </script>
    @endif
@endsection
