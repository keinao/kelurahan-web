<?php

namespace Tests\Feature;

use App\Models\Demographic;
use App\Models\Facility;
use App\Models\VillageProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicContentPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_contains_government_structure_and_regions(): void
    {
        $this->get(route('tentang'))
            ->assertOk()
            ->assertSee('Gambaran Umum')
            ->assertDontSee('Tomohon Maju, Berdaya Saing, dan Sejahtera')
            ->assertDontSee('Menjadikan Tomohon kota wisata dunia.')
            ->assertSee('Struktur Pemerintahan')
            ->assertSee('Boy S. Undap, SE')
            ->assertSee('Lingkungan VII');
    }

    public function test_about_page_shows_statistics_empty_state(): void
    {
        $this->get(route('tentang'))
            ->assertOk()
            ->assertSee('DEMOGRAFI')
            ->assertSee('Data Kependudukan')
            ->assertSee('Data kependudukan terverifikasi belum tersedia.')
            ->assertSee('href="#statistik"', false);
    }

    public function test_about_page_shows_demographics_when_available(): void
    {
        Demographic::create([
            'year' => 2026,
            'total_population' => 2456,
            'male_population' => 1228,
            'female_population' => 1228,
            'total_families' => 801,
            'total_lingkungan' => 7,
            'notes' => 'Semester 1 per 30 Juni 2026.',
        ]);

        $this->get(route('tentang'))
            ->assertOk()
            ->assertSee('DEMOGRAFI')
            ->assertSee('Data Kependudukan')
            ->assertSee('2.456')
            ->assertSee('1.228')
            ->assertSee('801')
            ->assertSee('7')
            ->assertSee('Semester 1 per 30 Juni 2026.')
            ->assertDontSee('Data kependudukan terverifikasi belum tersedia.');
    }

    public function test_kkt_members_page_shows_members_and_pendamping_from_central_data(): void
    {
        $this->get(route('anggota-kkt'))
            ->assertOk()
            ->assertSee('Anggota KKT')
            ->assertDontSee('Anggota Posko KKT')
            ->assertDontSee('Tim yang menjalankan kegiatan KKT di Kinilow.')
            ->assertSee('Ezra M. Tambaritji')
            ->assertSee('Divisi PDD')
            ->assertSee('Prof. Dr. Ir. Rignolda Djamaluddin, M. Sc')
            ->assertSee('Foto Ezra M. Tambaritji')
            ->assertDontSee('Data anggota KKT akan segera ditambahkan.');
    }
    public function test_legacy_pages_redirect_permanently(): void
    {
        $this->get('/statistik')->assertStatus(301)->assertRedirect('/tentang#statistik');
        $this->get('/profil')->assertStatus(301)->assertRedirect('/tentang');
        $this->get('/pemerintahan')->assertStatus(301)->assertRedirect('/tentang#struktur-pemerintahan');
        $this->get('/potensi')->assertStatus(301)->assertRedirect('/');
        $this->get('/potensi/contoh-lama')->assertStatus(301)->assertRedirect('/');
    }
    public function test_gallery_page_shows_program_cards_and_keyboard_lightbox(): void
    {
        $response = $this->get(route('galeri'));
        $response->assertOk()
            ->assertSee('Dokumentasi Kelurahan Kinilow')
            ->assertSee('Goes to School Area Privasiku')
            ->assertSee('Pengembangan Website Profil dan Layanan Informasi Kelurahan Kinilow')
            ->assertSee('1 foto')
            ->assertDontSee('Foto kegiatan akan segera ditambahkan.')
            ->assertSee('Tutup foto', false)
            ->assertSee('data-proker-index="0"', false)
            ->assertDontSee('Ezra M. Tambaritji');

        $this->assertSame(8, substr_count($response->getContent(), 'data-proker-index='));
    }
    public function test_facilities_page_shows_seeded_facilities_with_photos_and_maps(): void
    {
        $this->seed(\Database\Seeders\FacilitySeeder::class);

        $this->get(route('fasilitas'))
            ->assertOk()
            ->assertSee('Highland Resort &amp; Nature Tours', false)
            ->assertSee('Mountain View Resort &amp; Spa', false)
            ->assertSee('Where Travelers Meet Travelers')
            ->assertSee("Onong's Homestay Tomohon")
            ->assertSee('https://maps.app.goo.gl/1stbBgrNdfc4558F8')
            ->assertSee('Lihat di Google Maps')
            ->assertSee('data-facility-filter="penginapan"', false)
            ->assertSee('alt="Foto Air Terjun Kanderawatu"', false)
            ->assertDontSee('TODO: kategori belum ditentukan.')
            ->assertDontSee('Alamat belum diisi')
            ->assertDontSee('Highland Resort &amp; Nature Tours Contoh', false);

        $this->assertSame(10, Facility::active()->count());
    }

    public function test_facilities_page_uses_central_data_when_database_is_empty(): void
    {
        $this->get(route('fasilitas'))
            ->assertOk()
            ->assertSee('Highland Resort &amp; Nature Tours', false)
            ->assertSee('Foto Air Terjun Kanderawatu', false)
            ->assertSee('https://maps.app.goo.gl/1stbBgrNdfc4558F8')
            ->assertDontSee('Informasi fasilitas belum tersedia.');
    }

    public function test_contact_page_displays_only_confirmed_profile_fields(): void
    {
        VillageProfile::create([
            'name' => 'Kelurahan Kinilow',
            'phone' => '0431 123456',
            'email' => 'kontak@example.test',
            'office_hours' => 'Senin–Jumat, 08.00–16.00',
            'address' => '[DATA CONTOH] Alamat belum diisi.',
            'district' => 'Kecamatan Contoh',
            'map_url' => 'javascript:alert(1)',
        ]);

        $this->get(route('kontak'))
            ->assertOk()
            ->assertSee('0431 123456')
            ->assertSee('kontak@example.test')
            ->assertSee('Senin–Jumat, 08.00–16.00')
            ->assertDontSee('[DATA CONTOH]')
            ->assertDontSee('Kecamatan Contoh')
            ->assertDontSee('javascript:');
    }

    public function test_contact_page_shows_empty_states_when_no_profile_exists(): void
    {
        $this->get(route('kontak'))
            ->assertOk()
            ->assertSee('Informasi Kontak')
            ->assertSee('Informasi Kontak');
    }
}
