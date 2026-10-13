@extends('layouts.app')

@section('title', 'Tentang Kinilow — Kelurahan Kinilow')
@section('meta_description', 'Kenali sejarah, wilayah, penduduk, budaya, dan potensi Kelurahan Kinilow, Tomohon Utara.')
@section('og_title', 'Tentang Kinilow — Kelurahan Kinilow')
@section('og_description', 'Sejarah, warisan budaya, kehidupan masyarakat, dan potensi Kelurahan Kinilow.')

@section('content')
    <x-page-header
        title="Kinilow"
        subtitle="TENTANG KELURAHAN"
        intro="Merawat sejarah, budaya, dan potensi Kelurahan Kinilow."
    />

    <nav class="container py-3" aria-label="Navigasi bagian Tentang Kinilow">
        <ul class="nav nav-pills flex-wrap gap-2">
            <li class="nav-item"><a class="nav-link" href="#sejarah">Sejarah</a></li>
            <li class="nav-item"><a class="nav-link" href="#wilayah">Wilayah</a></li>
            <li class="nav-item"><a class="nav-link" href="#statistik">Penduduk</a></li>
            <li class="nav-item"><a class="nav-link" href="#budaya">Budaya</a></li>
            <li class="nav-item"><a class="nav-link" href="#potensi">Potensi</a></li>
            <li class="nav-item"><a class="nav-link" href="#struktur-pemerintahan">Pemerintahan</a></li>
            <li class="nav-item"><a class="nav-link" href="#kepala-lingkungan">Kepala Lingkungan</a></li>
        </ul>
    </nav>

    <section id="sejarah" class="kn-section kn-section--white" data-reveal aria-labelledby="sejarah-heading">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-start">
                <div class="col-lg-7">
                    <x-section-header id="sejarah-heading" title="Sejarah Kelurahan Kinilow" eyebrow="Dari masa ke masa" />
                    <div class="kn-about-copy">
                        <p>Kelurahan Kinilow merupakan salah satu dari 44 kelurahan di Kota Tomohon. Kota Tomohon dibentuk sebagai daerah otonom pada 2003; sebelumnya, wilayah ini merupakan bagian dari Kabupaten Minahasa, Provinsi Sulawesi Utara. Kinilow dahulu merupakan bagian dari Desa Kinilow yang kemudian terbagi menjadi Kelurahan Kinilow dan Kelurahan Kinilow Satu.</p>
                        <p>Dalam sejarah lisan masyarakat, Kinilow dikenal memiliki keterkaitan dengan permukiman leluhur yang disebut Kinilow Tua atau Nawanua. Cerita turun-temurun mengisahkan perjalanan leluhur, kehidupan masyarakat pada masa lampau, serta asal-usul nama Kinilow. Terdapat beberapa versi mengenai asal-usul nama tersebut, sehingga penelusuran bersama tokoh adat dan sumber sejarah lokal tetap diperlukan.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <aside class="kn-history-note h-100" aria-label="Catatan sejarah lisan">
                        <span class="kn-history-note__icon" aria-hidden="true"><i class="bi bi-book-half"></i></span>
                        <p class="kn-eyebrow">Ingatan kolektif</p>
                        <h3>Kinilow Tua &amp; Nawanua</h3>
                        <p class="mb-0">Kisah para leluhur hidup dalam cerita masyarakat. Mendokumentasikannya bersama tokoh adat membantu menjaga ingatan lokal untuk generasi berikutnya.</p>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    <section id="wilayah" class="kn-section kn-section--sand kn-batik-texture" data-reveal aria-labelledby="wilayah-heading">
        <div class="container">
            <x-section-header id="wilayah-heading" title="Di antara Lokon dan Mahawu" eyebrow="Letak dan Kondisi Geografis"
                lead="Kelurahan Kinilow berada di dataran tinggi Tomohon Utara, dengan udara sejuk dan bentang alam yang menghubungkan kehidupan warga dengan lingkungan sekitarnya." />

            <div class="row g-3 g-lg-4 mb-4">
                <div class="col-6 col-lg-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>± 600 ha</dd><dt>Luas wilayah</dt></dl>
                </div>
                <div class="col-6 col-lg-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>600–700 mdpl</dd><dt>Ketinggian</dt></dl>
                </div>
                <div class="col-6 col-lg-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>7</dd><dt>Lingkungan</dt></dl>
                </div>
                <div class="col-6 col-lg-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>Tomohon Utara</dd><dt>Kecamatan</dt></dl>
                </div>
            </div>

            <div class="kn-boundaries">
                <h3 class="h4">Batas wilayah</h3>
                <div class="row g-3">
                    <div class="col-12 col-sm-6"><dl class="kn-profile-fact h-100 mb-0"><dt>Utara</dt><dd class="mb-0">Kelurahan Tinoor Satu dan Desa Kali, Kabupaten Minahasa</dd></dl></div>
                    <div class="col-12 col-sm-6"><dl class="kn-profile-fact h-100 mb-0"><dt>Timur</dt><dd class="mb-0">Hutan Lindung dan Kabupaten Minahasa</dd></dl></div>
                    <div class="col-12 col-sm-6"><dl class="kn-profile-fact h-100 mb-0"><dt>Selatan</dt><dd class="mb-0">Kelurahan Kinilow Satu</dd></dl></div>
                    <div class="col-12 col-sm-6"><dl class="kn-profile-fact h-100 mb-0"><dt>Barat</dt><dd class="mb-0">Hutan Lindung</dd></dl></div>
                </div>
            </div>
        </div>
    </section>

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    <section id="statistik" class="kn-section kn-section--white" data-reveal aria-labelledby="statistik-heading">
        <div class="container">
            <x-section-header id="statistik-heading" title="Warga Kinilow" eyebrow="Data Kependudukan"
                lead="Data penduduk per 30 Juni 2026." />
            <div class="row g-3 g-lg-4">
                <div class="col-12 col-md-6">
                    <dl class="kn-about-stat kn-about-stat--feature h-100 mb-0"><dd>2.456 jiwa</dd><dt>Jumlah penduduk</dt></dl>
                </div>
                <div class="col-6 col-md-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>1.228</dd><dt>Laki-laki</dt></dl>
                </div>
                <div class="col-6 col-md-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>1.228</dd><dt>Perempuan</dt></dl>
                </div>
                <div class="col-12 col-md-6">
                    <dl class="kn-about-stat h-100 mb-0"><dd>801 keluarga</dd><dt>Jumlah kepala keluarga</dt></dl>
                </div>
                <div class="col-6 col-md-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>613</dd><dt>Kepala keluarga laki-laki</dt></dl>
                </div>
                <div class="col-6 col-md-3">
                    <dl class="kn-about-stat h-100 mb-0"><dd>188</dd><dt>Kepala keluarga perempuan</dt></dl>
                </div>
            </div>
            <p class="kn-about-footnote mt-3 mb-0">Masyarakat Kinilow sebagian besar memeluk agama Kristen. Mata pencaharian warga antara lain petani, penambang batu, dan pengrajin anyaman bambu.</p>
        </div>
    </section>

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    <section id="budaya" class="kn-section kn-section--sand" data-reveal aria-labelledby="budaya-heading">
        <div class="container">
            <x-section-header id="budaya-heading" title="Budaya yang hidup bersama masyarakat" eyebrow="Warisan dan identitas"
                lead="Budaya Kinilow berkelindan dengan kekayaan Minahasa, khususnya tradisi masyarakat Tombulu. Kebersamaan, penghormatan terhadap leluhur, dan hubungan dengan alam menjadi bagian penting dari warisan yang dijaga." />
            <div class="row g-3 g-lg-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-culture-card h-100"><span class="kn-culture-card__index">01</span><h3>Mapalus</h3><p>Tradisi kerja sama dan saling membantu yang mencerminkan kebersamaan, kepedulian sosial, dan tanggung jawab warga.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-culture-card h-100"><span class="kn-culture-card__index">02</span><h3>Bahasa &amp; tradisi lisan</h3><p>Bahasa daerah dan cerita tentang Kinilow Tua, asal-usul nama wilayah, serta pengalaman leluhur adalah pengetahuan yang perlu diwariskan.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-culture-card h-100"><span class="kn-culture-card__index">03</span><h3>Kerajinan bambu</h3><p>Keterampilan mengolah bambu menjadi kerajinan dan perlengkapan rumah tangga membawa nilai ekonomi sekaligus menjaga keterampilan tradisional.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-culture-card h-100"><span class="kn-culture-card__index">04</span><h3>Warisan sejarah &amp; adat</h3><p>Waruga, kubur batu tradisional masyarakat Minahasa, dan cerita adat membantu kita memahami tradisi leluhur serta perjalanan masyarakat.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-culture-card h-100"><span class="kn-culture-card__index">05</span><h3>Pengucapan syukur</h3><p>Tradisi yang dikenal luas di Minahasa ini mencerminkan rasa syukur, kebersamaan keluarga, dan hubungan sosial. Kebiasaan khusus di Kinilow perlu terus dikenali dan didokumentasikan.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <aside class="kn-culture-card kn-culture-card--closing h-100"><i class="bi bi-flower1" aria-hidden="true"></i><p class="mb-0">Melestarikan budaya berarti menjaga identitas lokal dan membuka ruang bagi generasi muda untuk mengenal warisan leluhur.</p></aside>
                </div>
            </div>
        </div>
    </section>

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    <section id="potensi" class="kn-section kn-section--white" data-reveal aria-labelledby="potensi-heading">
        <div class="container">
            <x-section-header id="potensi-heading" title="Alam, kerajinan, dan peluang" eyebrow="Potensi Kinilow"
                lead="Pariwisata dan UMKM berpeluang tumbuh bersama kekayaan alam, penginapan, dan keterampilan warga." />
            <div class="row g-3 g-lg-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-potential-card h-100"><i class="bi bi-mountains" aria-hidden="true"></i><h3>Wisata alam</h3><p>Gunung Lokon dan Gunung Empung serta Air Terjun Kanderawatu menawarkan daya tarik alam di sekitar Kinilow.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-potential-card h-100"><i class="bi bi-hourglass-split" aria-hidden="true"></i><h3>Warisan sejarah</h3><p>Waruga dan cerita sejarah lokal menjadi bagian dari kekayaan yang dapat dikenalkan dengan tetap menghormati nilai adat.</p></article>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="kn-potential-card h-100"><i class="bi bi-basket3" aria-hidden="true"></i><h3>UMKM &amp; kerajinan</h3><p>Sentra anyaman bambu, produk warga, hotel, dan penginapan mendukung peluang ekonomi serta pengalaman berkunjung.</p></article>
                </div>
            </div>
        </div>
    </section>

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    <section id="struktur-pemerintahan" class="kn-section kn-section--sand" data-reveal aria-labelledby="struktur-heading">
        <div class="container">
            <x-section-header id="struktur-heading" title="Struktur Pemerintahan" eyebrow="Perangkat Kelurahan" />
            <x-org-chart :struktur="$struktur" />
            <div class="mt-4 p-3 rounded bg-light border text-center">
                <p class="mb-0 small text-muted">
                    <i class="bi bi-info-circle me-1" aria-hidden="true"></i>
                    Berdasarkan data BPS Kota Tomohon (2026), Pemerintah Kelurahan Kinilow didukung oleh <strong>59 Pegawai Negeri Sipil (19 Laki-laki dan 40 Perempuan)</strong> serta mengoordinasikan <strong>7 Lingkungan</strong>.
                </p>
            </div>
        </div>
    </section>

    <div class="kn-pattern-ribbon kn-pattern-ribbon--batik" aria-hidden="true"></div>

    <section id="kepala-lingkungan" class="kn-section kn-section--white" data-reveal aria-labelledby="lingkungan-heading">
        <div class="container">
            <x-section-header id="lingkungan-heading" title="Kepala Lingkungan" eyebrow="Wilayah Kelurahan" />
            <div class="row g-3 g-lg-4">
                @foreach($struktur['lingkungan'] as $lingkungan)
                    <div class="col-12 col-md-6 col-xl-4">
                        <x-lingkungan-card :lingkungan="$lingkungan" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection