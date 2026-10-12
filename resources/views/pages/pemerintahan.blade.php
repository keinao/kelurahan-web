@extends('layouts.app')

@section('title', 'Pemerintahan — Kelurahan Kinilow')

@section('content')
    <x-page-header title="Pemerintahan" subtitle="Struktur Pemerintahan" />

    {{-- Statistik Demografi --}}
    @if($statistik->isNotEmpty())
        <section class="kn-section kn-section--sand" data-reveal aria-labelledby="statistik-heading">
            <div class="container">
                <x-section-header id="statistik-heading" title="Data Kependudukan {{ $demografi->year ?? '' }}" eyebrow="Demografi" />
                <div class="row g-3 justify-content-center">
                    @foreach($statistik as $label => $value)
                        <div class="col-6 col-md-4 col-lg">
                            <dl class="kn-profile-fact h-100 text-center mb-0">
                                <dd class="fs-3 fw-bold mb-1">{{ number_format($value, 0, ',', '.') }}</dd>
                                <dt>{{ $label }}</dt>
                            </dl>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    {{-- Pejabat --}}
    <section class="kn-section kn-section--white" data-reveal aria-labelledby="pejabat-heading">
        <div class="container">
            <x-section-header id="pejabat-heading" title="Aparatur Kelurahan" eyebrow="Pejabat" />
            @if($pejabat->count())
                <div class="row g-4 justify-content-center">
                    @foreach($pejabat as $p)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="kn-home-potential-card text-center h-100 p-4">
                                @if($p->photo)
                                    <div class="kn-static-image rounded-circle mx-auto mb-3" style="width:100px;height:100px">
                                        <x-static-image :src="$p->photo" :alt="$p->name" loading="lazy" />
                                    </div>
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:100px;height:100px;background:rgba(48,72,58,.1);color:#30483A">
                                        <i class="bi bi-person-fill fs-1" aria-hidden="true"></i>
                                    </div>
                                @endif
                                <h3 class="h6 fw-semibold mb-1">{{ $p->name }}</h3>
                                <small style="color:#686A63">{{ $p->position }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <x-empty-state message="Data aparatur belum tersedia." />
            @endif
        </div>
    </section>
@endsection