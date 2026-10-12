<?php

namespace Tests\Feature;

use App\Models\Demographic;
use App\Models\Facility;
use App\Models\Official;
use App\Models\Potential;
use App\Models\VillageProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicContentPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_potential_pages_show_only_active_non_example_records(): void
    {
        $valid = Potential::create([
            'name' => 'Kebun Produktif',
            'slug' => 'kebun-produktif',
            'category' => 'pertanian',
            'description' => 'Uraian yang diisi pengelola.',
            'location' => 'Lingkungan I',
            'is_active' => true,
        ]);
        Potential::create([
            'name' => 'Potensi Contoh',
            'slug' => 'potensi-contoh-test',
            'category' => 'lainnya',
            'description' => '[DATA CONTOH] Jangan ditampilkan.',
            'is_active' => true,
        ]);
        Potential::create([
            'name' => 'Potensi Nonaktif',
            'slug' => 'potensi-nonaktif-test',
            'category' => 'lainnya',
            'is_active' => false,
        ]);

        $this->get(route('potensi.index'))
            ->assertOk()
            ->assertSee($valid->name)
            ->assertDontSee('Potensi Contoh')
            ->assertDontSee('Potensi Nonaktif');

        $this->get(route('potensi.show', $valid->slug))
            ->assertOk()
            ->assertSee('Uraian yang diisi pengelola.');

        $this->get(route('potensi.show', 'potensi-nonaktif-test'))->assertNotFound();
        $this->get(route('potensi.show', 'potensi-contoh-test'))->assertNotFound();
    }

    public function test_government_page_uses_active_officials_and_available_demographics(): void
    {
        Official::create([
            'name' => 'Nama Perangkat',
            'position' => 'Sekretaris',
            'description' => null,
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Official::create([
            'name' => 'Nama Pejabat (Contoh)',
            'position' => 'Lurah',
            'description' => '[DATA CONTOH] Data contoh.',
            'sort_order' => 0,
            'is_head' => true,
            'is_active' => true,
        ]);
        Official::create([
            'name' => 'Perangkat Nonaktif',
            'position' => 'Staf',
            'is_active' => false,
        ]);
        Demographic::create([
            'year' => 2025,
            'total_population' => 1200,
            'male_population' => 600,
            'female_population' => 600,
            'total_families' => null,
            'total_lingkungan' => null,
            'notes' => null,
        ]);

        $this->get(route('pemerintahan'))
            ->assertOk()
            ->assertSee('Nama Perangkat')
            ->assertDontSee('Nama Pejabat (Contoh)')
            ->assertDontSee('Perangkat Nonaktif')
            ->assertSee('1.200')
            ->assertSee('Data tahun 2025.');
    }

    public function test_government_page_handles_no_verified_data(): void
    {
        Official::create([
            'name' => 'Nama Contoh',
            'position' => 'Jabatan Contoh',
            'description' => '[DATA CONTOH] Isi contoh.',
            'is_active' => true,
        ]);
        Demographic::create([
            'year' => 2026,
            'total_population' => null,
            'male_population' => null,
            'female_population' => null,
            'total_families' => null,
            'total_lingkungan' => null,
            'notes' => '[DATA CONTOH] Belum tersedia.',
        ]);

        $this->get(route('pemerintahan'))
            ->assertOk()
            ->assertSee('Data perangkat kelurahan belum tersedia')
            ->assertSee('Data kependudukan terverifikasi belum tersedia');
    }

    public function test_gallery_page_has_a_clear_empty_state_when_no_images_exist(): void
    {
        $this->get(route('galeri'))
            ->assertOk()
            ->assertSee('Dokumentasi kegiatan akan ditampilkan di sini.')
            ->assertSee('Anggota Posko KKT')
            ->assertSee('Sepri Tandira_Pak')
            ->assertSee('Foto anggota belum tersedia');
    }

    public function test_facilities_page_shows_active_real_records_and_handles_empty_state(): void
    {
        Facility::create([
            'name' => 'Puskesmas Wilayah',
            'category' => 'kesehatan',
            'address' => 'Jalan Merdeka',
            'description' => 'Layanan kesehatan.',
            'map_url' => 'https://maps.example.test/location',
            'is_active' => true,
        ]);
        Facility::create([
            'name' => 'Fasilitas Contoh',
            'category' => 'lainnya',
            'address' => '[DATA CONTOH] Alamat.',
            'is_active' => true,
        ]);
        Facility::create([
            'name' => 'Fasilitas Nonaktif',
            'category' => 'lainnya',
            'is_active' => false,
        ]);

        $this->get(route('fasilitas'))
            ->assertOk()
            ->assertSee('Puskesmas Wilayah')
            ->assertSee('Jalan Merdeka')
            ->assertSee('https://maps.example.test/location')
            ->assertDontSee('Fasilitas Contoh')
            ->assertDontSee('Fasilitas Nonaktif');
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
            ->assertSee('Informasi telepon, email')
            ->assertSee('Alamat dan tautan lokasi belum tersedia.');
    }
}