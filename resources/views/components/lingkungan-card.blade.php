@props(['lingkungan'])

<article class="kn-lingkungan-card">
    <h3 class="kn-lingkungan-card__title">Lingkungan {{ $lingkungan['nomor'] }}</h3>
    <div class="kn-lingkungan-card__people">
        <x-official-card :person="$lingkungan['kaling']" heading-level="4" />
        <x-official-card :person="$lingkungan['wakaling']" heading-level="4" />
    </div>
</article>
