@extends('layouts.app')

@section('title', 'Profil — Kelurahan Kinilow')

@section('content')
    <x-page-header title="Profil Kelurahan" subtitle="Mengenal Lebih Dekat" variant="profil" />

    @if($villageProfile)
        @if($villageProfile->history)
            <section class="kn-section kn-section--white" data-reveal>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <x-section-header title="Sejarah" eyebrow="Asal Usul" />
                            <div class="kn-prose">{!! nl2br(e($villageProfile->history)) !!}</div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

        @if($villageProfile->geographic_info)
            <section class="kn-section kn-section--sand kn-batik-texture" data-reveal>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <x-section-header title="Geografis" eyebrow="Wilayah" />
                            <div class="kn-prose">{!! nl2br(e($villageProfile->geographic_info)) !!}</div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($villageProfile->vision || $villageProfile->mission)
            <section class="kn-section kn-section--white" data-reveal>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            @if($villageProfile->vision)
                                <x-section-header title="Visi" eyebrow="Arah Pembangunan" />
                                <div class="kn-prose mb-5">{!! nl2br(e($villageProfile->vision)) !!}</div>
                            @endif
                            @if($villageProfile->mission)
                                <x-section-header title="Misi" eyebrow="Langkah Strategis" />
                                <div class="kn-prose">{!! nl2br(e($villageProfile->mission)) !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @else
        <section class="kn-section kn-section--white">
            <div class="container">
                <x-empty-state message="Profil kelurahan belum tersedia." />
            </div>
        </section>
    @endif
@endsection
