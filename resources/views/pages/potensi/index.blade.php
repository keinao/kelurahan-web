@extends('layouts.app')

@section('title', 'Potensi — Kelurahan Kinilow')

@section('content')
    <x-page-header title="Potensi Kelurahan" subtitle="Keunggulan Daerah" />

    <section class="kn-section kn-section--white" data-reveal>
        <div class="container">
            @if($potensi->count())
                <div class="row g-4">
                    @foreach($potensi as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="kn-home-potential-card h-100 d-flex flex-column">
                                @if($item->image)
                                    <div class="kn-static-image mb-3" style="aspect-ratio:16/10">
                                        <x-static-image :src="$item->image" :alt="$item->name" loading="lazy" />
                                    </div>
                                @endif
                                <div class="text-center p-3 flex-grow-1 d-flex flex-column">
                                    <h3>{{ $item->name }}</h3>
                                    @if($item->category)
                                        <span class="kn-eyebrow align-self-center" style="font-size:.68rem">{{ $item->category }}</span>
                                    @endif
                                    @if($item->description)
                                        <p class="flex-grow-1">{{ Str::limit(strip_tags($item->description), 100) }}</p>
                                    @endif
                                    <a href="{{ route('potensi.show', $item->slug) }}" class="kn-arrow-link justify-content-center mt-auto">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($potensi->hasPages())
                    <nav class="mt-5" aria-label="Halaman potensi">
                        {{ $potensi->links() }}
                    </nav>
                @endif
            @else
                <x-empty-state message="Belum ada data potensi yang dipublikasikan." icon="bi-star" />
            @endif
        </div>
    </section>
@endsection