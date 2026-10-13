@props(['member'])

@php
    $nameParts = preg_split('/[^\pL\pN]+/u', trim($member['nama']), -1, PREG_SPLIT_NO_EMPTY);
    $initials = collect($nameParts)
        ->take(2)
        ->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
@endphp

<article class="kn-official-card h-100">
    <div class="kn-official-card__avatar">
        @if(!empty($member['foto']))
            <img src="{{ asset($member['foto']) }}" alt="Foto {{ $member['nama'] }}" loading="lazy">
        @else
            <span aria-hidden="true">{{ $initials }}</span>
        @endif
    </div>
    <div class="kn-official-card__content">
        <h3 class="kn-official-card__name">{{ $member['nama'] }}</h3>
        @if(!empty($member['peran']))
            <p class="kn-official-card__role mt-1">{{ $member['peran'] }}</p>
        @endif
        @if(!empty($member['program_studi']))
            <p class="small mb-0">{{ $member['program_studi'] }}</p>
        @endif
        @if(!empty($member['kampus']))
            <p class="small mb-0">{{ $member['kampus'] }}</p>
        @endif
    </div>
</article>