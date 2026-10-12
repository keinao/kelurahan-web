@extends('layouts.app')

@section('title', 'Fasilitas — Kelurahan Kinilow')

@section('content')
    <x-page-header title="Fasilitas" subtitle="Sarana & Prasarana" />

    <section class="kn-section kn-section--white" data-reveal>
        <div class="container">
            @if($fasilitas->count())
                <div class="row g-4">
                    @foreach($fasilitas as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="kn-home-potential-card h-100 p-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:rgba(48,72,58,.1);color:#30483A">
                                            <i class="bi bi-building fs-5" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="h6 fw-semibold mb-1">{{ $item['name'] }}</h3>
                                        <span class="kn-eyebrow" style="margin-bottom:.4rem;font-size:.68rem">{{ $item['category'] }}</span>
                                        @if($item['address'])
                                            <p class="small mb-1" style="color:#686A63"><i class="bi bi-geo-alt me-1" aria-hidden="true"></i>{{ $item['address'] }}</p>
                                        @endif
                                        @if($item['description'])
                                            <p class="small mb-0" style="color:#686A63">{{ $item['description'] }}</p>
                                        @endif
                                        @if($item['map_url'])
                                            <a href="{{ $item['map_url'] }}" target="_blank" rel="noopener" class="kn-arrow-link mt-2" style="font-size:.85rem">
                                                <i class="bi bi-map" aria-hidden="true"></i>Lihat Peta
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <x-empty-state message="Data fasilitas belum tersedia." />
            @endif
        </div>
    </section>
@endsection