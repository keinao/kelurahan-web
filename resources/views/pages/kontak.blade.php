@extends('layouts.app')

@section('title', 'Kontak — Kelurahan Kinilow')

@section('content')
    <x-page-header title="Kontak" subtitle="Hubungi Kami" />

    <section class="kn-section kn-section--white" data-reveal>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6">
                    <div class="kn-home-potential-card h-100 p-4">
                        <x-section-header title="Informasi Kontak" eyebrow="Detail" />
                        <ul class="list-unstyled mb-0">
                            @if($kontak['alamat'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-geo-alt" style="color:#30483A" aria-hidden="true"></i>
                                    <span>{{ $kontak['alamat'] }}@if($kontak['district']), {{ $kontak['district'] }}@endif @if($kontak['regency']), {{ $kontak['regency'] }}@endif</span>
                                </li>
                            @endif
                            @if($kontak['phone'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-telephone" style="color:#30483A" aria-hidden="true"></i>
                                    <a href="tel:{{ $kontak['phone'] }}" class="text-decoration-none">{{ $kontak['phone'] }}</a>
                                </li>
                            @endif
                            @if($kontak['whatsapp'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-whatsapp" style="color:#30483A" aria-hidden="true"></i>
                                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $kontak['whatsapp']) }}" class="text-decoration-none" target="_blank" rel="noopener">{{ $kontak['whatsapp'] }}</a>
                                </li>
                            @endif
                            @if($kontak['email'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-envelope" style="color:#30483A" aria-hidden="true"></i>
                                    <a href="mailto:{{ $kontak['email'] }}" class="text-decoration-none">{{ $kontak['email'] }}</a>
                                </li>
                            @endif
                            @if($kontak['office_hours'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-clock" style="color:#30483A" aria-hidden="true"></i>
                                    <span>{{ $kontak['office_hours'] }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if($kontak['map_url'])
                    <div class="col-lg-6">
                        <div class="kn-static-image overflow-hidden h-100" style="min-height:350px;border-radius:.5rem">
                            <iframe src="{{ $kontak['map_url'] }}" width="100%" height="100%" style="border:0;min-height:350px" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Peta lokasi Kelurahan Kinilow"></iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection