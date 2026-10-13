@extends('layouts.app')

@section('title', 'Kontak - Kelurahan Kinilow')
@section('meta_description', 'Nomor WhatsApp dan lokasi Kantor Kelurahan Kinilow.')

@section('content')
    <x-page-header title="Kontak" subtitle="Hubungi Kami" />

    <section class="kn-section kn-contact-section" data-reveal>
        <div class="container">
            <div class="row g-4 g-xl-5 align-items-stretch">
                <div class="col-lg-6">
                    <div class="kn-contact-info-card h-100">
                        <x-section-header title="Informasi Kontak" eyebrow="Kantor Kelurahan" />
                        <ul class="kn-contact-info-list list-unstyled mb-0">
                            @if($kontak['alamat'])
                                <li class="kn-contact-info-item">
                                    <span class="kn-contact-info-item__icon" aria-hidden="true"><i class="bi bi-geo-alt"></i></span>
                                    <span class="kn-contact-info-item__text">{{ $kontak['alamat'] }}@if($kontak['district']), {{ $kontak['district'] }}@endif @if($kontak['regency']), {{ $kontak['regency'] }}@endif</span>
                                </li>
                            @endif
                            @if($kontak['whatsapp'])
                                <li class="kn-contact-info-item">
                                    <span class="kn-contact-info-item__icon kn-contact-info-item__icon--whatsapp" aria-hidden="true"><i class="bi bi-whatsapp"></i></span>
                                    <span class="kn-contact-info-item__text">
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $kontak['whatsapp']) }}" class="kn-contact-info-item__link" target="_blank" rel="noopener noreferrer">
                                            WhatsApp {{ $kontak['whatsapp'] }} <i class="bi bi-arrow-up-right kn-contact-info-item__arrow" aria-hidden="true"></i>
                                        </a>
                                        @if($kontak['contact_person'])
                                            <span class="kn-contact-info-item__contact-person">{{ $kontak['contact_position'] }}<br>{{ $kontak['contact_person'] }}</span>
                                        @endif
                                    </span>
                                </li>
                            @endif
                            @if($kontak['office_hours'])
                                <li class="kn-contact-info-item">
                                    <span class="kn-contact-info-item__icon" aria-hidden="true"><i class="bi bi-clock"></i></span>
                                    <span class="kn-contact-info-item__text">Jam Operasional: {{ $kontak['office_hours'] }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if($kontak['map_url'])
                    <div class="col-lg-6">
                        <div class="kn-contact-map-card h-100">
                            <div class="kn-contact-map-card__visual" aria-hidden="true">
                                <svg viewBox="0 0 520 210" focusable="false">
                                    <path d="M-20 164c55-74 106-67 148-17s87 48 130-14 88-75 132-26 75 45 142-17" />
                                    <path d="M-26 189c65-61 99-57 140-14s87 52 137-9 91-67 132-26 81 52 158-8" />
                                    <path d="M-24 134c53-69 106-75 151-23s81 36 126-26 94-66 141-13 76 36 141-18" />
                                    <path d="M33 18c45 29 70 30 112 4s79-18 108 14 69 41 110 14 83-39 137-7" />
                                    <path d="M-8 68c52-40 101-41 144-3s85 49 130 17 94-37 137-6 74 30 126-5" />
                                </svg>
                                <span class="kn-contact-map-card__pin"><i class="bi bi-geo-alt-fill"></i></span>
                                <span class="kn-contact-map-card__visual-label">KINILOW</span>
                            </div>
                            <div class="kn-contact-map-card__content">
                                <p class="kn-eyebrow">Lokasi</p>
                                <h2>Kantor Kelurahan Kinilow</h2>
                                <p>Temukan titik kantor dan petunjuk arah melalui Google Maps.</p>
                                <a href="{{ $kontak['map_url'] }}" class="kn-contact-map-card__link" target="_blank" rel="noopener noreferrer">
                                    Buka titik kantor <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection