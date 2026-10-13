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
                            <button
                                class="kn-gallery-proker-card"
                                type="button"
                                data-proker-index="{{ $loop->index }}"
                                aria-label="Buka {{ $item['judul'] }}, {{ count($item['foto']) }} foto"
                            >
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
                                    <span class="kn-gallery-proker-card__count">{{ count($item['foto']) }} foto</span>
                                </span>
                            </button>
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

    @if ($proker->isNotEmpty())
        <dialog class="kn-gallery-lightbox" id="proker-lightbox" aria-labelledby="proker-lightbox-title">
            <div class="kn-gallery-lightbox__header">
                <div>
                    <h2 id="proker-lightbox-title"></h2>
                    <p id="proker-lightbox-count" aria-live="polite"></p>
                </div>
                <button class="kn-gallery-lightbox__close" type="button" aria-label="Tutup foto">&times;</button>
            </div>
            <div class="kn-gallery-lightbox__content">
                <button class="kn-gallery-lightbox__nav" type="button" data-direction="previous" aria-label="Foto sebelumnya">&#8592;</button>
                <img class="kn-gallery-lightbox__image" alt="" width="1600" height="900">
                <button class="kn-gallery-lightbox__nav" type="button" data-direction="next" aria-label="Foto berikutnya">&#8594;</button>
            </div>
        </dialog>

        <script>
            (() => {
                const items = @json($proker->values());
                const assetBase = @json(asset(''));
                const dialog = document.getElementById('proker-lightbox');
                const image = dialog.querySelector('.kn-gallery-lightbox__image');
                const title = dialog.querySelector('#proker-lightbox-title');
                const count = dialog.querySelector('#proker-lightbox-count');
                const closeButton = dialog.querySelector('.kn-gallery-lightbox__close');
                const navButtons = dialog.querySelectorAll('[data-direction]');
                let activeProker = 0;
                let activePhoto = 0;
                let opener = null;

                const showPhoto = () => {
                    const item = items[activeProker];
                    const photo = item.foto[activePhoto];
                    title.textContent = item.judul;
                    count.textContent = `${activePhoto + 1} / ${item.foto.length}`;
                    image.src = new URL(photo.file, assetBase.endsWith('/') ? assetBase : `${assetBase}/`).href;
                    image.alt = photo.alt;
                    image.width = photo.full_width;
                    image.height = photo.full_height;
                    navButtons.forEach((button) => { button.disabled = item.foto.length < 2; });
                };

                document.querySelectorAll('[data-proker-index]').forEach((button) => {
                    button.addEventListener('click', () => {
                        activeProker = Number(button.dataset.prokerIndex);
                        activePhoto = 0;
                        opener = button;
                        showPhoto();
                        dialog.showModal();
                        closeButton.focus();
                    });
                });

                closeButton.addEventListener('click', () => dialog.close());
                dialog.addEventListener('click', (event) => {
                    if (event.target === dialog) dialog.close();
                });
                dialog.addEventListener('close', () => opener?.focus());
                navButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        const photos = items[activeProker].foto;
                        const direction = button.dataset.direction === 'next' ? 1 : -1;
                        activePhoto = (activePhoto + direction + photos.length) % photos.length;
                        showPhoto();
                    });
                });
                dialog.addEventListener('keydown', (event) => {
                    if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
                    event.preventDefault();
                    const photos = items[activeProker].foto;
                    const direction = event.key === 'ArrowRight' ? 1 : -1;
                    activePhoto = (activePhoto + direction + photos.length) % photos.length;
                    showPhoto();
                });
            })();
        </script>
    @endif
@endsection