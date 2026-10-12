@props(['src' => null, 'path' => null, 'alt' => '', 'ratio' => '4x3'])
@php
    // Support both 'src' (URL/storage path) and 'path' (public path) props
    if ($path) {
        // path-based: check if file exists in public directory
        $ekstensiValid = filled($path) && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'], true);
        $tersedia = $ekstensiValid && ! str_contains($path, '..') && \Illuminate\Support\Facades\File::isFile(public_path($path));
        $imageUrl = $tersedia ? asset($path) : null;
    } elseif ($src) {
        // src-based: external URL or storage path
        $isExternal = str_starts_with($src, 'http://') || str_starts_with($src, 'https://');
        $imageUrl = $isExternal ? $src : asset('storage/' . ltrim($src, '/'));
        $tersedia = true;
    } else {
        $imageUrl = null;
        $tersedia = false;
    }
@endphp
<div {{ $attributes->class(['kn-static-image'])->merge(['style' => $path ? '' : null]) }}>
    @if ($tersedia && $imageUrl)
        <img src="{{ $imageUrl }}" alt="{{ $alt }}" loading="lazy">
    @else
        <div class="kn-static-image__fallback" role="img"
             aria-label="{{ $alt !== '' ? $alt.' (gambar belum tersedia)' : 'Gambar belum tersedia' }}">
            <span class="kn-static-image__label">Gambar segera hadir</span>
        </div>
    @endif
</div>