@extends('layouts.app')

@section('title', 'Informasi — Kelurahan Kinilow')

@section('content')
    <x-page-header title="Informasi & Berita" subtitle="Berita Terbaru" />

    <section class="kn-section kn-section--white" data-reveal>
        <div class="container">
            @if($berita->count())
                <div class="row g-4">
                    @foreach($berita as $item)
                        <div class="col-md-6 col-lg-4">
                            <article class="kn-home-news-card h-100 d-flex flex-column">
                                @if($item->image)
                                    <div class="kn-static-image mb-3" style="aspect-ratio:16/10">
                                        <x-static-image :src="$item->image" :alt="$item->title" loading="lazy" />
                                    </div>
                                @endif
                                <p class="kn-home-news-card__meta">
                                    <i class="bi bi-calendar3" aria-hidden="true"></i>
                                    <time datetime="{{ $item->published_at->toDateString() }}">{{ $item->published_at->translatedFormat('d F Y') }}</time>
                                </p>
                                <h3>{{ $item->title }}</h3>
                                <p class="flex-grow-1">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                                <a href="{{ route('informasi.show', $item->slug) }}" class="kn-arrow-link mt-auto">Selengkapnya</a>
                            </article>
                        </div>
                    @endforeach
                </div>

                @if($berita->hasPages())
                    <nav class="mt-5" aria-label="Halaman berita">
                        {{ $berita->links() }}
                    </nav>
                @endif
            @else
                <x-empty-state message="Belum ada informasi yang dipublikasikan." icon="bi-newspaper" />
            @endif
        </div>
    </section>
@endsection