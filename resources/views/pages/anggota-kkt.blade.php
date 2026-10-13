@extends('layouts.app')

@section('title', 'Anggota KKT - Kelurahan Kinilow')
@section('meta_description', 'Profil anggota KKT dan pendamping yang bertugas di Kelurahan Kinilow.')
@section('og_title', 'Anggota KKT - Kelurahan Kinilow')
@section('og_description', 'Daftar anggota KKT dan pendamping di Kelurahan Kinilow.')

@section('content')
    <x-page-header title="Anggota KKT" subtitle="ANGGOTA KKT" />

    <section class="kn-section kn-section--white" aria-label="Anggota dan pendamping KKT">
        <div class="container">

            @if (!empty($anggota->get('pimpinan_pembimbing')))
                <section class="kn-gallery kn-gallery--mentors p-4 mb-5 rounded-2" aria-labelledby="kkt-pendamping-heading">
                    <x-section-header
                        id="kkt-pendamping-heading"
                        title="Tim Pendamping"
                    />
                    <div class="row g-3 g-lg-4">
                        @foreach ($anggota->get('pimpinan_pembimbing') as $item)
                            <article class="col-12 col-md-4">
                                <div class="kn-gallery-mentor-card h-100">
                                    <p>{{ $item['jabatan'] }}</p>
                                    <h3>{{ $item['nama'] }}</h3>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @forelse ($anggota->get('kelompok', []) as $kelompok)
                <section class="kn-gallery-group mt-5" aria-labelledby="{{ $kelompok['id'] }}">
                    <x-section-header id="{{ $kelompok['id'] }}" title="{{ $kelompok['nama'] }}" />
                    <div class="row g-3 g-lg-4">
                        @foreach ($kelompok['anggota'] as $member)
                            @php
                                $fotoAnggota = $member['foto'] ?? null;
                                $fotoTersedia = $fotoAnggota && is_file(public_path($fotoAnggota));
                            @endphp
                            <article class="col-6 col-md-4 col-xl-3">
                                <div class="kn-gallery-member-card">
                                    <div class="kn-gallery-member-card__portrait">
                                        @if ($fotoTersedia)
                                            <img src="{{ asset($fotoAnggota) }}" alt="Foto {{ $member['nama'] }}" loading="lazy">
                                        @else
                                            <div class="kn-gallery-member-card__placeholder">
                                                <i class="bi bi-person" aria-hidden="true"></i>
                                                <span>Foto anggota belum tersedia</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="kn-gallery-member-card__body">
                                        <h3>{{ $member['nama'] }}</h3>
                                        <p>{{ $member['peran'] }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @empty
                @if (empty($anggota->get('pimpinan_pembimbing')))
                    <x-empty-state message="Data anggota KKT akan segera ditambahkan." icon="bi-people" />
                @endif
            @endforelse
        </div>
    </section>
@endsection