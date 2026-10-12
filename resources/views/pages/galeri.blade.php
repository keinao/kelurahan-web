@php
    $kelompokAnggota = [
        [
            'id' => 'pengurus-inti',
            'nama' => 'Pengurus Inti',
            'anggota' => [
                ['nama' => 'Ezra M. Tambaritji', 'peran' => 'Koordinator Posko', 'foto' => 'images/gallery/anggota/Ezra.JPG'],
                ['nama' => 'Abigael Senduk', 'peran' => 'Sekretaris', 'foto' => 'images/gallery/anggota/Abigael.JPG'],
                ['nama' => 'Vancel Rengkung', 'peran' => 'Bendahara', 'foto' => 'images/gallery/anggota/Vancel.JPG'],
            ],
        ],
        [
            'id' => 'divisi-pdd',
            'nama' => 'Divisi PDD',
            'anggota' => [
                ['nama' => 'Claudia Makapuas', 'peran' => 'Koordinator', 'foto' => 'images/gallery/anggota/Claudia.jpg'],
                ['nama' => 'Dian Faitji', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Faitji.jpg'],
                ['nama' => 'Natalia Pandey', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Natalia.jpg'],
                ['nama' => 'Tiara Laia', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Tiara.jpg'],
            ],
        ],
        [
            'id' => 'divisi-pdp',
            'nama' => 'Divisi PDP',
            'anggota' => [
                ['nama' => 'Intan Hingkua', 'peran' => 'Koordinator', 'foto' => 'images/gallery/anggota/Intan.JPG'],
                ['nama' => 'Jeannette Liow', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Jeannette.JPG'],
                ['nama' => 'Mikha Tiwa', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Mikha.JPG'],
                ['nama' => "Sepri Tandira'pak", 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Sepri.JPG'],
            ],
        ],
        [
            'id' => 'divisi-humas',
            'nama' => 'Divisi Humas',
            'anggota' => [
                ['nama' => 'Cantika Anggreine Arina', 'peran' => 'Koordinator', 'foto' => 'images/gallery/anggota/Cantika.JPG'],
                ['nama' => 'Yohana Pabangnga', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Yohana.JPG'],
                ['nama' => 'Narwasti Sondok', 'peran' => 'Anggota', 'foto' => 'images/gallery/anggota/Narwasti.JPG'],
            ],
        ],
    ];

    $pimpinanPembimbing = [
        ['jabatan' => 'Koordinator P3KKNT', 'nama' => 'Prof. Dr. Ir. Rignolda Djamaluddin, M. Sc'],
        ['jabatan' => 'Dosen Pengawas', 'nama' => 'Prof. Dr. Ir. Laurentius J.M. Rumokoy, M.Sc., DESS, IPU, ASEAN Eng.'],
        ['jabatan' => 'Dosen Pembimbing', 'nama' => "Dr. Wahida Ma'ruf, Spt, Msi"],
    ];
@endphp

@extends('layouts.app')

@section('title', 'Galeri | Kelurahan Kinilow')
@section('meta_description', 'Pengenalan anggota Posko KKT UNSRAT Angkatan 149 di Kinilow dan dokumentasi kegiatannya.')

@section('content')
    <x-page-header
        title="Galeri"
        subtitle="KKT UNSRAT Angkatan 149 — Posko Kinilow"
        variant="gallery"
        intro="Kenali anggota Posko KKT UNSRAT Angkatan 149 di Kinilow dan dokumentasikan perjalanan kegiatan bersama masyarakat."
    />

    <section class="kn-section kn-gallery kn-gallery--mentors" data-reveal>
        <div class="container">
            <x-section-header
                eyebrow="Pendampingan"
                title="Pimpinan dan Pembimbing"
                lead=""
            />

            <div class="row g-3 g-lg-4">
                @foreach ($pimpinanPembimbing as $item)
                    <article class="col-12 col-md-4">
                        <div class="kn-gallery-mentor-card">
                            <p>{{ $item['jabatan'] }}</p>
                            <h3>{{ $item['nama'] }}</h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="kn-section kn-gallery kn-gallery--members" data-reveal>
        <div class="container">
            <x-section-header
                eyebrow="Tim KKT"
                title="Anggota Posko KKT"
                lead="Bagian ini memperkenalkan tim yang menjalankan kegiatan KKT di Kinilow."
            />

            @foreach ($kelompokAnggota as $kelompok)
                <section class="kn-gallery-group" aria-labelledby="{{ $kelompok['id'] }}">
                    <div class="kn-gallery-group__heading">
                        <h3 id="{{ $kelompok['id'] }}">{{ $kelompok['nama'] }}</h3>
                    </div>

                    <div class="row g-3 g-lg-4">
                        @foreach ($kelompok['anggota'] as $anggota)
                            @php
                                $fotoAnggota = $anggota['foto'];
                                $fotoTersedia = $fotoAnggota && \Illuminate\Support\Facades\File::isFile(public_path($fotoAnggota));
                            @endphp
                            <article class="col-6 col-md-4 col-xl-3">
                                <div class="kn-gallery-member-card">
                                    <div class="kn-gallery-member-card__portrait">
                                        @if ($fotoTersedia)
                                            <img src="{{ asset($fotoAnggota) }}" alt="Foto {{ $anggota['nama'] }}" loading="lazy">
                                        @else
                                            <div class="kn-gallery-member-card__placeholder">
                                                <i class="bi bi-person" aria-hidden="true"></i>
                                                <span>Foto anggota belum tersedia</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="kn-gallery-member-card__body">
                                        <h4>{{ $anggota['nama'] }}</h4>
                                        <p>{{ $anggota['peran'] }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </section>

    <section class="kn-section kn-gallery kn-gallery--documentation" data-reveal>
        <div class="container">
            <x-section-header
                eyebrow="Catatan perjalanan"
                title="Dokumentasi Kegiatan"
                lead="Foto kegiatan KKT, aktivitas bersama masyarakat, dan program kerja."
            />

            @if ($gambar->isNotEmpty())
                <div class="row g-3 g-lg-4">
                    @foreach ($gambar as $foto)
                        <div class="col-6 col-md-4">
                            <a
                                class="kn-gallery-documentation__link"
                                href="{{ $foto['src'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Buka foto dokumentasi {{ $foto['name'] }}"
                            >
                                <div class="kn-gallery-documentation__image">
                                    <img src="{{ $foto['src'] }}" alt="{{ $foto['name'] }}" loading="lazy">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <x-empty-state
                    message="Dokumentasi kegiatan akan ditampilkan di sini."
                    icon="bi-camera"
                />
            @endif
        </div>
    </section>
@endsection
