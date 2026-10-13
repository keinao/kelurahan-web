<footer class="kn-site-footer">
    <div class="container">
        <div class="row g-4 py-4">
            <div class="col-lg-5">
                <h2 class="kn-footer-heading">Kelurahan Kinilow</h2>
                <p class="small mb-0" style="opacity:.72">Kecamatan Tomohon Utara, Kota Tomohon, Sulawesi Utara.</p>
            </div>
            <div class="col-lg-4">
                <h3 class="kn-footer-heading">Tautan</h3>
                <ul class="kn-footer-list">
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang Kinilow</a></li>
                    <li><a href="{{ route('informasi.index') }}">Layanan Publik</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri</a></li>
                    <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
                    <li><a href="{{ route('anggota-kkt') }}">Anggota KKT</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h3 class="kn-footer-heading">Hubungi Kami</h3>
                <ul class="kn-footer-list" style="opacity:.72">
                    <li><i class="bi bi-geo-alt me-2" aria-hidden="true"></i>Kinilow, Tomohon Utara</li>
                    <li><i class="bi bi-whatsapp me-2" aria-hidden="true"></i><a href="https://wa.me/6281241385188" target="_blank" rel="noopener noreferrer">+62 812-4138-5188</a></li><li><i class="bi bi-geo-alt me-2" aria-hidden="true"></i><a href="https://maps.app.goo.gl/rKm8sGoKiioYE9gb9" target="_blank" rel="noopener noreferrer">Lokasi Kantor</a></li>
                </ul>
            </div>
        </div>
        <div class="kn-footer-bottom text-center">&copy; {{ date('Y') }} Kelurahan Kinilow. Hak cipta dilindungi.</div>
    </div>
</footer>
