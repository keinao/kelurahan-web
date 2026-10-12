@extends('layouts.app')

@section('title', $judul)

@section('content')
    <x-page-header :title="$judul" :batik="request()->routeIs('beranda', 'profil')" />

    <div class="container pb-5">
        <x-empty-state icon="bi-hourglass-split" message="Halaman ini sedang dalam pembangunan." />

        {{-- Uji komponen static-image. Dihapus bersama view sementara ini. --}}
        <div class="row justify-content-center">
            <div class="col-6 col-md-3">
                <x-static-image path="images/hero/hero.jpg" alt="Uji komponen gambar" />
            </div>
        </div>
    </div>
@endsection