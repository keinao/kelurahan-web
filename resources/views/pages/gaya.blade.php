@extends('layouts.app')
@section('title', 'Sistem Desain')
@section('meta_description', 'Pratinjau sistem desain editorial Kelurahan Kinilow.')
@section('content')
    @php
        $warna = [
            ['Warm Ivory', '#F7F4ED', '#252923'], ['Putih', '#FFFFFF', '#252923'],
            ['Charcoal', '#252923', '#FFFFFF'], ['Deep Forest', '#30483A', '#FFFFFF'],
            ['Earth Brown', '#8B6F47', '#FFFFFF'], ['Earth teks', '#7A5F3A', '#FFFFFF'],
            ['Sand', '#ECE6D8', '#252923'], ['Muted Gray', '#686A63', '#FFFFFF'],
            ['Muted Sage · dekorasi', '#879B78', '#252923'], ['Natural Bamboo · dekorasi', '#C9B98A', '#252923'],
        ];
        $batikPathWebp = 'images/patterns/batik-kinilow.webp';
        $batikPathPng = 'images/patterns/batik-kinilow.png';
        $batikPath = \Illuminate\Support\Facades\File::isFile(public_path($batikPathWebp))
            ? $batikPathWebp
            : $batikPathPng;
        $batikTersedia = \Illuminate\Support\Facades\File::isFile(public_path($batikPath));
    @endphp
    <x-page-header eyebrow="Pratinjau desain" :title="'Gaya ' . ($villageProfile?->name ?? config('app.name'))"
        lead="Sistem visual yang hangat dan editorial untuk informasi publik, potensi, budaya, dan kehidupan masyarakat." />
    <section class="kn-section @if ($batikTersedia) kn-batik-texture @endif" data-reveal
        @if ($batikTersedia) style="--kn-batik-pattern: url('{{ asset($batikPath) }}')" @endif>
        <div class="container">
            <x-section-header eyebrow="Tipografi" title="Dua keluarga font, satu suara yang jelas."
                lead="Cormorant Garamond Variable untuk judul dan Inter Variable untuk isi." />
            <div class="kn-type-sample"><p class="kn-type-sample__display">Ruang hidup dan cerita masyarakat.</p>
                <p class="kn-type-sample__body">Informasi publik yang dekat, hangat, dan mudah dibaca warga maupun pengunjung.</p></div>
        </div>
    </section>
    <section class="kn-section kn-section--white" data-reveal><div class="container">
        <x-section-header eyebrow="Warna" title="Palet alam dan warisan lokal." />
        <div class="row g-3">@foreach ($warna as [$nama, $hex, $teks])
            <div class="col-6 col-md-4 col-lg-3"><div class="kn-swatch" style="background-color: {{ $hex }}; color: {{ $teks }};">
                <strong>{{ $nama }}</strong><span>{{ $hex }}</span></div></div>
        @endforeach</div>
    </div></section>
    <section class="kn-section @if ($batikTersedia) kn-batik-texture @endif" data-reveal
        @if ($batikTersedia) style="--kn-batik-pattern: url('{{ asset($batikPath) }}')" @endif><div class="container">
        <x-section-header eyebrow="Aksi" title="Tombol dan tautan." />
        <div class="kn-style-row d-flex flex-wrap align-items-center gap-3">
            <a class="btn btn-primary" href="{{ route('beranda') }}">Jelajahi</a>
            <a class="btn btn-outline-primary" href="{{ route('profil') }}">Baca profil</a>
            <a class="kn-arrow-link" href="{{ route('informasi.index') }}">Lihat informasi</a>
        </div>
    </div></section>
    <section class="kn-section kn-section--white" data-reveal><div class="container">
        <x-section-header eyebrow="Gambar" title="Foto dapat hadir bertahap." />
        <div class="row g-4"><div class="col-md-6"><x-static-image path="images/hero/hero.jpg" alt="Contoh foto suasana Kelurahan" ratio="16x9" /></div>
            <div class="col-md-6"><x-empty-state message="Konten akan ditampilkan rapi saat tersedia." /></div></div>
    </div></section>
@endsection
