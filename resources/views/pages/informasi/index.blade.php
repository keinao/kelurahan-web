@extends('layouts.app')

@section('title', 'Layanan Publik - Kelurahan Kinilow')
@section('meta_description', 'Alur pelayanan, persyaratan dokumen, dan informasi publik Kelurahan Kinilow.')

@section('content')
    <x-page-header title="Layanan Publik" subtitle="Alur dan Persyaratan" />

    <section class="kn-public-services" aria-label="Alur dan persyaratan layanan publik">
        <div class="kn-public-main">
            <nav class="kn-public-nav" aria-label="Navigasi layanan publik">
          <a href="#alur-pelayanan">Alur pelayanan</a>
          <a href="#persyaratan">Persyaratan dokumen</a>
        </nav>
            <section class="kn-public-section" id="alur-pelayanan" aria-labelledby="alur-heading">
        <div class="kn-public-section-heading">
          <p class="kn-public-kicker">Tahapan layanan</p>
          <h2 id="alur-heading">Alur pelayanan</h2>
          <p>Ikuti urutan berikut untuk mengajukan pelayanan di Kelurahan Kinilow.</p>
        </div>

        <div class="kn-public-flow-grid">
          <article class="kn-public-flow-card">
            <span class="kn-public-flow-card__number" aria-hidden="true">01</span>
            <h3>Pelayanan umum administrasi</h3>
            <ol class="kn-public-steps">
              <li>Masyarakat</li>
              <li>Kepala Lingkungan</li>
              <li>Kantor Kelurahan (administrasi)</li>
              <li>Berkas dikirim ke aplikasi e-Dukcapil Tomohon</li>
            </ol>
            <p class="kn-public-flow-note"><strong>Catatan:</strong> Iuran sampah dan PBB wajib lunas pada tahap Kepala Lingkungan.</p>
          </article>

          <article class="kn-public-flow-card">
            <span class="kn-public-flow-card__number" aria-hidden="true">02</span>
            <h3>Pelayanan umum dokumen hilang</h3>
            <ol class="kn-public-steps">
              <li>Masyarakat</li>
              <li>Kepala Lingkungan</li>
              <li>Kantor Kelurahan</li>
              <li>Polsek</li>
            </ol>
          </article>

          <article class="kn-public-flow-card">
            <span class="kn-public-flow-card__number" aria-hidden="true">03</span>
            <h3>Pendataan pengukuran tanah</h3>
            <ol class="kn-public-steps">
              <li>Masyarakat mengajukan permohonan ke Kantor Kelurahan</li>
              <li>Berkas lengkap dan memenuhi syarat</li>
              <li>Tim pengukur</li>
              <li>Tim menuju lokasi pengukuran</li>
              <li>Menunggu 14 hari kerja untuk menerima dokumen berita acara pengukuran tanah</li>
            </ol>
            <p class="kn-public-requirement"><strong>Persyaratan:</strong> KTP, mengisi formulir, dan riwayat tanah.</p>
          </article>
        </div>
      </section>

      <section class="kn-public-section" id="persyaratan" aria-labelledby="persyaratan-heading">
        <div class="kn-public-section-heading">
          <p class="kn-public-kicker">Siapkan berkas</p>
          <h2 id="persyaratan-heading">Persyaratan dokumen</h2>
          <p>Pilih jenis layanan untuk melihat daftar persyaratannya.</p>
        </div>

        <div class="kn-public-category-list">
          <section class="kn-public-category" aria-labelledby="kategori-identitas">
            <div class="kn-public-category__heading"><span class="kn-public-category__index" aria-hidden="true">01</span><h3 id="kategori-identitas">Kartu identitas dan Kartu Keluarga</h3></div>
            <div class="kn-public-accordion">
              <details>
                <summary>Penerbitan Kartu Identitas Anak (KIA)</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Fotokopi Kartu Keluarga</li>
                  <li>Fotokopi akta kelahiran</li>
                  <li>Pas foto bagi anak usia 5–17 tahun</li>
                </ul></div>
              </details>
              <details>
                <summary>KTP-el bagi penduduk WNI</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Kartu Keluarga</li>
                  <li>Akta perkawinan untuk penduduk berusia di bawah 17 tahun</li>
                  <li>Akta kelahiran</li>
                  <li>Surat keterangan datang dari luar negeri</li>
                </ul>
                <p class="kn-public-clarify"><strong>Perlu konfirmasi:</strong> Sumber mencantumkan syarat “akta perkawinan untuk penduduk berusia di bawah 17 tahun”. Mohon pastikan apakah syarat ini sudah tepat.</p>
                </div>
              </details>
              <details>
                <summary>Perubahan elemen data KTP-el</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Kartu Keluarga yang sudah diperbarui</li>
                  <li>KTP elektronik lama</li>
                </ul></div>
              </details>
              <details>
                <summary>KTP-el hilang atau rusak</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>KTP elektronik yang rusak</li>
                  <li>Surat keterangan hilang dari kepolisian</li>
                  <li>Kartu Keluarga</li>
                </ul></div>
              </details>
              <details>
                <summary>Kartu Keluarga baru</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Formulir permohonan Kartu Keluarga dari kelurahan yang ditandatangani Lurah</li>
                  <li>Formulir isian biodata (F1.01) dari kelurahan yang ditandatangani Lurah</li>
                  <li>Akta perkawinan, akta perceraian, atau akta kematian</li>
                  <li>Akta kelahiran anggota 1, 2, 3, dan 4</li>
                  <li>Surat keterangan pindah atau pindah datang bagi penduduk yang pindah dalam wilayah NKRI; surat keterangan datang dari luar negeri yang diterbitkan oleh instansi pelaksana bagi WNI yang datang dari luar negeri karena pindah</li>
                  <li>Mengisi formulir F-1.01</li>
                </ul>
                <p class="kn-public-clarify"><strong>Perlu konfirmasi:</strong> Sumber menulis “akta kelahiran anggota 1, 2, 3, 4”. Mohon pastikan anggota keluarga yang dimaksud.</p>
                </div>
              </details>
              <details>
                <summary>Surat pindah WNI keluar Tomohon</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Formulir pindah WNI (mengisi F1-03)</li>
                  <li>Kartu Keluarga asli</li>
                </ul></div>
              </details>
            </div>
          </section>

          <section class="kn-public-category" aria-labelledby="kategori-perubahan-kk">
            <div class="kn-public-category__heading"><span class="kn-public-category__index" aria-hidden="true">02</span><h3 id="kategori-perubahan-kk">Perubahan Kartu Keluarga</h3></div>
            <div class="kn-public-accordion">
              <details>
                <summary>Perubahan KK karena kelahiran</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Kartu Keluarga lama</li>
                  <li>Akta kelahiran</li>
                  <li>Foto formulir F.1.15</li>
                </ul></div>
              </details>
              <details>
                <summary>Perubahan KK karena menumpang</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Kartu Keluarga lama</li>
                  <li>Kartu Keluarga yang akan ditumpangi</li>
                  <li>Surat keterangan pindah atau pindah datang bagi penduduk yang pindah dalam wilayah NKRI; surat keterangan datang dari luar negeri yang diterbitkan oleh instansi pelaksana bagi WNI yang datang dari luar negeri karena pindah</li>
                  <li>Foto formulir F.1.15</li>
                  <li>Fotokopi akta kelahiran (1), (2), (3), dan (4)</li>
                  <li>Surat pernyataan bersedia menerima sebagai anggota keluarga F1-03B</li>
                  <li>Fotokopi akta kawin</li>
                  <li>Surat kuasa pengasuhan anak dari orang tua atau wali</li>
                </ul>
                <p class="kn-public-clarify"><strong>Perlu konfirmasi:</strong> Sumber menulis “fotokopi akta lahir (1), (2), (3), (4)”. Mohon pastikan anggota keluarga yang dimaksud.</p>
                </div>
              </details>
              <details>
                <summary>Perubahan KK karena pengurangan anggota</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Kartu Keluarga lama</li>
                  <li>Fotokopi akta kematian</li>
                  <li>Surat keterangan pindah atau pindah datang bagi penduduk yang pindah dalam wilayah NKRI, atau surat keterangan datang dari luar negeri yang diterbitkan oleh instansi pelaksana bagi WNI yang datang dari luar negeri karena pindah</li>
                  <li>Foto formulir F.1.15</li>
                  <li>Fotokopi akta perkawinan bagi anggota keluarga yang akan pisah KK atau membentuk KK baru</li>
                </ul></div>
              </details>
              <details>
                <summary>Perubahan KK karena rusak atau hilang</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Surat keterangan hilang dari kepolisian</li>
                  <li>Kartu Keluarga yang rusak</li>
                </ul></div>
              </details>
              <details>
                <summary>Perubahan elemen data pada KK</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Kartu Keluarga asli (catatan perubahan yang dimaksud)</li>
                  <li>Fotokopi akta kelahiran (1), (2), dan (3) bagi yang ada perubahan elemen data di KK</li>
                  <li>Fotokopi akta perkawinan, kematian, atau perceraian untuk perubahan status</li>
                  <li>Surat pernyataan perubahan elemen data — F1.06</li>
                </ul></div>
              </details>
              <details>
                <summary>Perubahan KK karena pindah (kelurahan/kecamatan)</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Surat keterangan pindah WNI (antar kelurahan atau kecamatan) dari kelurahan</li>
                  <li>Kartu Keluarga asli</li>
                  <li>Fotokopi akta perkawinan, kematian, atau perceraian</li>
                  <li>Formulir perpindahan penduduk WNI</li>
                </ul></div>
              </details>
            </div>
          </section>

          <section class="kn-public-category" aria-labelledby="kategori-akta-lahir">
            <div class="kn-public-category__heading"><span class="kn-public-category__index" aria-hidden="true">03</span><h3 id="kategori-akta-lahir">Akta kelahiran</h3></div>
            <div class="kn-public-accordion">
              <details>
                <summary>Akta kelahiran baru</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Foto surat kelahiran dari dokter</li>
                  <li>Foto nama dan identitas saksi kelahiran</li>
                  <li>Foto Kartu Keluarga orang tua</li>
                  <li>Foto KTP orang tua</li>
                  <li>Foto akta nikah atau perkawinan</li>
                  <li>Surat keterangan kelahiran dari kelurahan</li>
                  <li>Formulir pelaporan kelahiran dari kelurahan</li>
                  <li>SPTJM kelahiran bagi yang tidak ada keterangan lahir dari rumah sakit</li>
                  <li>SPTJM suami istri bagi yang tidak ada akta perkawinan</li>
                </ul></div>
              </details>
              <details>
                <summary>Akta kelahiran 60 hari ke atas</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Surat kelahiran dari dokter</li>
                  <li>Nama dan identitas saksi kelahiran</li>
                  <li>Kartu Keluarga orang tua</li>
                  <li>KTP orang tua</li>
                  <li>Akta perkawinan</li>
                  <li>Surat keterangan kelahiran dari kelurahan</li>
                  <li>Formulir pelaporan kelahiran dari kelurahan</li>
                  <li>Surat permohonan pelaporan melampaui batas kelahiran 60 hari ke atas</li>
                  <li>SPTJM kelahiran bagi yang tidak ada keterangan lahir dari rumah sakit</li>
                  <li>SPTJM suami istri bagi yang tidak ada akta perkawinan</li>
                </ul></div>
              </details>
              <details>
                <summary>Akta kelahiran usia 1–16 tahun</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Surat kelahiran dari dokter</li>
                  <li>Nama dan identitas saksi kelahiran</li>
                  <li>Kartu Keluarga orang tua</li>
                  <li>KTP orang tua</li>
                  <li>Akta perkawinan</li>
                  <li>Surat keterangan kelahiran dari kelurahan</li>
                  <li>Formulir pelaporan kelahiran dari kelurahan</li>
                  <li>Surat pernyataan belum pernah menerbitkan akta kelahiran 1 tahun ke atas</li>
                  <li>SPTJM kelahiran bagi yang tidak ada keterangan lahir dari rumah sakit</li>
                  <li>SPTJM suami istri bagi yang tidak ada akta perkawinan</li></ul><p class="kn-public-clarify"><strong>Perlu konfirmasi:</strong> Mohon pastikan maksud frasa 1 tahun ke atas pada persyaratan ini.</p></div>
              </details>
              <details>
                <summary>Akta kelahiran usia 17 tahun ke atas</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Surat kelahiran dari dokter</li>
                  <li>Nama dan identitas saksi kelahiran</li>
                  <li>Kartu Keluarga orang tua</li>
                  <li>KTP orang tua</li>
                  <li>Akta perkawinan</li>
                  <li>Surat keterangan kelahiran dari kelurahan</li>
                  <li>Formulir pelaporan kelahiran dari kelurahan</li>
                  <li>Surat pernyataan belum pernah menerbitkan akta kelahiran 17 tahun ke atas</li>
                  <li>SPTJM kelahiran bagi yang tidak ada keterangan lahir dari rumah sakit</li>
                  <li>SPTJM suami istri bagi yang tidak ada akta perkawinan</li>
                </ul></div>
              </details>
              <details>
                <summary>Akta kelahiran hilang atau rusak</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Fotokopi Kartu Keluarga</li>
                  <li>Surat keterangan hilang dari kepolisian bagi akta kelahiran yang hilang</li>
                  <li>Fotokopi akta kelahiran</li>
                </ul></div>
              </details>
            </div>
          </section>

          <section class="kn-public-category" aria-labelledby="kategori-akta-lain">
            <div class="kn-public-category__heading"><span class="kn-public-category__index" aria-hidden="true">04</span><h3 id="kategori-akta-lain">Akta kematian, perkawinan, dan perceraian</h3></div>
            <div class="kn-public-accordion">
              <details>
                <summary>Akta kematian</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Surat keterangan kematian dari kelurahan</li>
                  <li>Formulir pelaporan kematian dari kelurahan</li>
                  <li>Surat keterangan kematian dari rumah sakit</li>
                  <li>Surat pernyataan jika yang meninggal sudah 1 tahun ke atas</li>
                  <li>Surat pernyataan kehilangan akta kematian</li>
                  <li>SPTJM kematian bagi yang tidak memiliki surat keterangan kematian dari rumah sakit</li>
                  <li>Surat keterangan hilang dari kepolisian bagi akta kematian yang hilang</li>
                  <li>Kartu Keluarga asli</li></ul><p class="kn-public-clarify"><strong>Perlu konfirmasi:</strong> Mohon pastikan maksud frasa yang meninggal sudah 1 tahun ke atas pada persyaratan ini.</p></div>
              </details>
              <details>
                <summary>Akta perkawinan</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Fotokopi surat telah terjadinya perkawinan dari pemuka agama</li>
                  <li>Pas foto berwarna calon suami istri</li>
                  <li>KTP-el calon suami istri</li>
                  <li>Kartu Keluarga calon suami istri</li>
                  <li>Fotokopi akta kematian pasangan bagi yang cerai mati</li>
                  <li>Fotokopi akta perceraian bagi yang cerai hidup</li>
                  <li>Surat izin dari atasan jika calon pengantin berstatus anggota TNI atau Kepolisian Republik Indonesia</li>
                </ul></div>
              </details>
              <details>
                <summary>Akta perceraian</summary>
                <div class="kn-public-accordion__body"><ul>
                  <li>Putusan perceraian dari pengadilan asli</li>
                  <li>Pengantar dari pengadilan</li>
                  <li>Akta perkawinan asli suami istri</li>
                  <li>KTP suami istri</li>
                  <li>Kartu Keluarga suami istri</li>
                  <li>Formulir pencatatan perceraian</li>
                  <li>Formulir permohonan perceraian</li>
                </ul></div>
              </details>
            </div>
          </section>
        </div>
      </section>
        </div>
    </section>
@endsection
