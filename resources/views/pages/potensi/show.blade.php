@extends('layouts.app')

@section('title', $potensi->name . ' — Kelurahan Kinilow')
@section('meta_description', Str::limit(strip_tags($potensi->description ?? ''), 160))

@section('content')
    <x-page-header :title="$potensi->name" :subtitle="$potensi->category ?? 'Potensi Kelurahan'" />

    <section class="kn-section kn-section--white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <a href="{{ route('potensi.index') }}" class="kn-back-link">Kembali ke Potensi</a>

                    <article class="kn-prose">
                        @if($potensi->image)
                            <figure class="mb-4">
                                <div class="kn-static-image" style="aspect-ratio:16/9;border-radius:.5rem">
                                    <x-static-image :src="$potensi->image" :alt="$potensi->name" />
                                </div>
                            </figure>
                        @endif

                        @if($potensi->description)
                            <div>{!! nl2br(e($potensi->description)) !!}</div>
                        @endif
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection