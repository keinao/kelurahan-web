@props(['title', 'subtitle' => null, 'variant' => null, 'intro' => null])

<section class="kn-page-header {{ $variant === 'gallery' ? '' : 'kn-batik-texture' }} {{ $variant ? 'kn-page-header--'.$variant : '' }}" aria-labelledby="page-header-title">
    <div class="container">
        @if($subtitle)
            <p class="kn-eyebrow">{{ $subtitle }}</p>
        @endif
        <h1 id="page-header-title">{{ $title }}</h1>
        @if($intro)
            <p class="kn-page-header__intro">{{ $intro }}</p>
        @endif
    </div>
</section>
