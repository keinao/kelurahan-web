@props(['message' => 'Belum ada data yang tersedia.', 'icon' => 'bi-inbox'])

<div class="kn-empty-state">
    <i class="bi {{ $icon }} fs-1 d-block mb-3 opacity-50" aria-hidden="true"></i>
    <p>{{ $message }}</p>
</div>