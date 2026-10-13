@extends('layouts.app')

@section('title', 'Kontak - Kelurahan Kinilow')
@section('meta_description', 'Nomor WhatsApp dan lokasi Kantor Kelurahan Kinilow.')

@section('content')
    <x-page-header title="Kontak" subtitle="Hubungi Kami" />

    <section class="kn-section kn-section--white" data-reveal>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6">
                    <div class="kn-home-potential-card h-100 p-4">
                        <x-section-header title="Informasi Kontak" eyebrow="Kantor Kelurahan" />
                        <ul class="list-unstyled mb-0">
                            @if($kontak['alamat'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-geo-alt" style="color:#30483A" aria-hidden="true"></i>
                                    <span>{{ $kontak['alamat'] }}@if($kontak['district']), {{ $kontak['district'] }}@endif @if($kontak['regency']), {{ $kontak['regency'] }}@endif</span>
                                </li>
                            @endif
                            @if($kontak['whatsapp'])
                                <li class="mb-3 d-flex gap-2">
                                    <i class="bi bi-whatsapp" style="color:#30483A" aria-hidden="true"></i>
                                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $kontak['whatsapp']) }}" class="text-decoration-none" target="_blank" rel="noopener noreferrer">
                                        WhatsApp {{ $kontak['whatsapp'] }}
                                    </a>
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
                        <div class="kn-contact-map-card h-100">
                            <span class="kn-contact-map-card__icon" aria-hidden="true"><i class="bi bi-geo-alt"></i></span>
                            <p class="kn-eyebrow">Lokasi</p>
                            <h2>Kantor Kelurahan Kinilow</h2>
                            <p>Temukan titik kantor dan petunjuk arah melalui Google Maps.</p>
                            <a href="{{ $kontak['map_url'] }}" class="kn-contact-map-card__link" target="_blank" rel="noopener noreferrer">
                                Buka titik kantor <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection