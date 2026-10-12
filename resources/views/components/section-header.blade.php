@props(['title', 'id' => null, 'eyebrow' => null, 'lead' => null])

<div class="kn-section-header">
    <div>
        @if($eyebrow)
            <p class="kn-eyebrow">{{ $eyebrow }}</p>
        @endif
        <h2 @if($id) id="{{ $id }}" @endif>{{ $title }}</h2>
        @if($lead)
            <p class="kn-section-header__lead">{{ $lead }}</p>
        @endif
    </div>
    {{ $slot }}
</div>