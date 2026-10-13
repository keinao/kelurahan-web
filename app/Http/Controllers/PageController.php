<?php

namespace App\Http\Controllers;

use App\Models\Demographic;
use App\Models\Facility;
use App\Models\News;
use App\Models\VillageProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function beranda(): View
    {
        $berita = News::published()
            ->where('content', 'not like', '%[DATA CONTOH]%')
            ->latest('published_at')
            ->take(3)
            ->get();

        $bpsData = null;
        if (File::exists(base_path('data/data-bps-kinilow.json'))) {
            $bpsData = json_decode(File::get(base_path('data/data-bps-kinilow.json')), true);
        }

        return view('pages.beranda', compact('berita', 'bpsData'));
    }

    public function tentang(): View
    {
        $villageProfile = VillageProfile::query()->first();

        $documentContent = [
            'history' => 'Kelurahan Kinilow merupakan salah satu kelurahan di wilayah Kecamatan Tomohon Utara, Kota Tomohon. Dahulunya Kinilow merupakan satu kesatuan Desa Kinilow yang kemudian berkembang dan dimekarkan menjadi Kelurahan Kinilow dan Kelurahan Kinilow Satu seiring dengan terbentuknya Kota Tomohon sebagai kota otonom.',
            'geography' => 'Kelurahan Kinilow berada di kawasan dataran tinggi pada ketinggian rata-rata ± 700 meter di atas permukaan laut (mdpl), diapit oleh panorama Gunung Lokon dan Gunung Mahawu dengan suhu udara yang sejuk. Berdasarkan publikasi resmi BPS (Kecamatan Tomohon Utara Dalam Angka 2026), Kinilow merupakan kelurahan terluas di Kecamatan Tomohon Utara dengan luas daratan mencapai 6,00 km² (13,16% dari luas wilayah kecamatan), serta berjarak 3,00 km dari pusat ibukota kecamatan dan 3,00 km dari pusat Kota Tomohon.',
            'boundaries' => [
                'Utara' => 'Kelurahan Tinoor Satu dan Desa Kali, Kabupaten Minahasa',
                'Timur' => 'Hutan Lindung dan Kabupaten Minahasa',
                'Selatan' => 'Kelurahan Kinilow Satu',
                'Barat' => 'Hutan Lindung',
            ],
        ];

        $usable = static fn (?string $value): bool => is_string($value)
            && trim($value) !== ''
            && ! preg_match('/\[DATA CONTOH\]|\bcontoh\b/i', $value);
        $prefer = static fn (?string $value, string $fallback): string => $usable($value)
            ? trim($value)
            : $fallback;

        $profileContent = [
            'history' => $prefer($villageProfile?->history, $documentContent['history']),
            'geography' => $prefer($villageProfile?->geography, $documentContent['geography']),
            'boundaries' => [
                'Utara' => $prefer($villageProfile?->boundary_north, $documentContent['boundaries']['Utara']),
                'Timur' => $prefer($villageProfile?->boundary_east, $documentContent['boundaries']['Timur']),
                'Selatan' => $prefer($villageProfile?->boundary_south, $documentContent['boundaries']['Selatan']),
                'Barat' => $prefer($villageProfile?->boundary_west, $documentContent['boundaries']['Barat']),
            ],

        ];

        $demografi = Demographic::query()
            ->where(function ($query): void {
                $query->whereNull('notes')
                    ->orWhere('notes', 'not like', '%[DATA CONTOH]%');
            })
            ->orderByDesc('year')
            ->first();

        $statistik = collect([
            'Jumlah penduduk' => $demografi?->total_population,
            'Laki-laki' => $demografi?->male_population,
            'Perempuan' => $demografi?->female_population,
            'Jumlah keluarga' => $demografi?->total_families,
            'Jumlah lingkungan' => $demografi?->total_lingkungan,
        ])->filter(fn ($value): bool => $value !== null);
        $struktur = json_decode(File::get(base_path('data/perangkat.json')), true, flags: JSON_THROW_ON_ERROR);

        $bpsData = null;
        if (File::exists(base_path('data/data-bps-kinilow.json'))) {
            $bpsData = json_decode(File::get(base_path('data/data-bps-kinilow.json')), true);
        }

        return view('pages.tentang', compact('villageProfile', 'profileContent', 'struktur', 'demografi', 'statistik', 'bpsData'));
    }

    public function anggotaKkt(): View
    {
        $anggota = collect(json_decode(
            File::get(base_path('data/anggota-kkt.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        ));

        return view('pages.anggota-kkt', compact('anggota'));
    }
    public function galeri(): View
    {
        $proker = collect(json_decode(
            File::get(base_path('data/galeri.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        ));

        return view('pages.galeri', compact('proker'));
    }

    public function fasilitas(): View
    {
        $fasilitas = Facility::active()
            ->whereRaw('LOWER(name) NOT LIKE ?', ['%contoh%'])
            ->orderBy('category')
            ->orderBy('name')
            ->get()
            ->map(function (Facility $item): array {
                $mapUrl = filled($item->map_url)
                    && in_array(parse_url($item->map_url, PHP_URL_SCHEME), ['http', 'https'], true)
                    ? $item->map_url
                    : null;

                return [
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'subtitle' => $item->subtitle,
                    'category_key' => $item->category,
                    'category' => Facility::CATEGORIES[$item->category] ?? null,
                    'description' => $item->description,
                    'photos' => $item->photos ?? [],
                    'map_url' => $mapUrl,
                ];
            });

        if ($fasilitas->isEmpty()) {
            $fasilitas = collect(json_decode(
                File::get(base_path('data/fasilitas.json')),
                true,
                flags: JSON_THROW_ON_ERROR,
            ))->map(function (array $item): array {
                $mapUrl = in_array(parse_url($item['maps_url'], PHP_URL_SCHEME), ['http', 'https'], true)
                    ? $item['maps_url']
                    : null;

                return [
                    'name' => $item['nama'],
                    'slug' => $item['slug'],
                    'subtitle' => $item['subtitle'],
                    'category_key' => $item['kategori'],
                    'category' => Facility::CATEGORIES[$item['kategori']] ?? null,
                    'description' => $item['deskripsi'],
                    'photos' => $item['foto'],
                    'map_url' => $mapUrl,
                ];
            })->values();
        }

        return view('pages.fasilitas', compact('fasilitas'));
    }

    public function kontak(): View
    {
        $profile = VillageProfile::query()->first();
        $availableText = fn (?string $value): ?string => filled($value)
            && ! preg_match('/\[DATA CONTOH\]|\bcontoh\b|belum diisi|belum tersedia/i', $value)
            ? trim($value)
            : null;

        $mapUrl = 'https://maps.app.goo.gl/rKm8sGoKiioYE9gb9';
        if ($mapUrl && (! filter_var($mapUrl, FILTER_VALIDATE_URL)
            || ! in_array(parse_url($mapUrl, PHP_URL_SCHEME), ['http', 'https'], true))) {
            $mapUrl = null;
        }

        $kontak = [
            'nama' => $availableText($profile?->name),
            'alamat' => $availableText($profile?->address),
            'district' => $availableText($profile?->district),
            'regency' => $availableText($profile?->regency),
            'province' => $availableText($profile?->province),
            'phone' => null,
            'whatsapp' => '+62 896-0394-0811',
            'contact_person' => 'Alfian M. L. Mantiaha, S.Sos',
            'contact_position' => 'Kasie Kesejahteraan Rakyat',
            'email' => null,
            'office_hours' => '08.00 - 16.30 WITA',
            'map_url' => $mapUrl,
        ];

        return view('pages.kontak', compact('kontak'));
    }
}
