@extends('layouts.app')

@section('title', $berita->title . ' — Kelurahan Kinilow')
@section('meta_description', $metaDescription)

@section('content')
    <x-page-header :title="$berita->title" :subtitle="$berita->published_at->translatedFormat('d F Y')" />

    <section class="kn-section kn-section--white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <a href="{{ route('informasi.index') }}" class="kn-back-link">Kembali ke Layanan Publik</a>

                    <article class="kn-prose">
                        @if($berita->image)
                            <figure class="mb-4">
                                <div class="kn-static-image" style="aspect-ratio:16/9;border-radius:.5rem">
                                    <x-static-image :src="$berita->image" :alt="$berita->title" />
                                </div>
                            </figure>
                        @endif

                        <div>{!! $isiAman !!}</div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection