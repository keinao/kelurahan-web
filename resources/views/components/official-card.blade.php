@props(['person', 'headingLevel' => 3])

@php
    $nameParts = preg_split('/[^\pL\pN]+/u', trim($person['nama']), -1, PREG_SPLIT_NO_EMPTY);
    $initials = collect($nameParts)
        ->take(2)
        ->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
@endphp

<article class="kn-official-card">
    <div class="kn-official-card__avatar">
        @if(!empty($person['foto']))
            <img src="{{ asset($person['foto']) }}" alt="Foto {{ $person['nama'] }}" loading="lazy">
        @else
            <span aria-hidden="true">{{ $initials }}</span>
        @endif
    </div>
    <div class="kn-official-card__content">
        <p class="kn-official-card__role">{{ $person['jabatan'] }}</p>
        @if($headingLevel === 4)
            <h4 class="kn-official-card__name">{{ $person['nama'] }}</h4>
        @else
            <h3 class="kn-official-card__name">{{ $person['nama'] }}</h3>
        @endif
    </div>
</article>
