<?php

namespace App\Http\Controllers;

use App\Models\Demographic;
use App\Models\Facility;
use App\Models\News;
use App\Models\Official;
use App\Models\Potential;
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

        $potensi = Potential::active()
            ->featured()
            ->where(function ($query): void {
                $query->whereNull('description')
                    ->orWhere('description', 'not like', '%[DATA CONTOH]%');
            })
            ->orderBy('name')
            ->take(3)
            ->get();

        return view('pages.beranda', compact('berita', 'potensi'));
    }

    public function profil(): View
    {
        return view('pages.profil', [
            'villageProfile' => VillageProfile::query()->first(),
        ]);
    }

    public function pemerintahan(): View
    {
        $pejabat = Official::active()
            ->whereRaw('LOWER(name) NOT LIKE ?', ['%contoh%'])
            ->where(function ($query): void {
                $query->whereNull('description')
                    ->orWhere('description', 'not like', '%[DATA CONTOH]%');
            })
            ->orderByDesc('is_head')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

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

        return view('pages.pemerintahan', compact('pejabat', 'demografi', 'statistik'));
    }

    public function galeri(): View
    {
        $direktori = public_path('images/gallery');
        $gambar = collect(File::isDirectory($direktori) ? File::files($direktori) : [])
            ->filter(fn ($file): bool => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp'], true))
            ->sortBy(fn ($file): string => strtolower($file->getFilename()))
            ->map(fn ($file): array => [
                'src' => asset('images/gallery/'.$file->getFilename()),
                'name' => $file->getFilename(),
            ])
            ->values();

        return view('pages.galeri', compact('gambar'));
    }

    public function fasilitas(): View
    {
        $fasilitas = Facility::active()
            ->whereRaw('LOWER(name) NOT LIKE ?', ['%contoh%'])
            ->orderBy('category')
            ->orderBy('name')
            ->get()
            ->map(function (Facility $item): array {
                $availableText = fn (?string $value): ?string => filled($value)
                    && ! str_contains(mb_strtolower($value), '[data contoh]')
                    && ! str_contains(mb_strtolower($value), 'contoh')
                    ? trim($value)
                    : null;

                $mapUrl = $availableText($item->map_url);
                if ($mapUrl && ! in_array(parse_url($mapUrl, PHP_URL_SCHEME), ['http', 'https'], true)) {
                    $mapUrl = null;
                }

                return [
                    'name' => $item->name,
                    'category' => Facility::CATEGORIES[$item->category] ?? 'Fasilitas',
                    'address' => $availableText($item->address),
                    'description' => $availableText($item->description),
                    'map_url' => $mapUrl,
                ];
            });

        return view('pages.fasilitas', compact('fasilitas'));
    }

    public function kontak(): View
    {
        $profile = VillageProfile::query()->first();
        $availableText = fn (?string $value): ?string => filled($value)
            && ! preg_match('/\[DATA CONTOH\]|\bcontoh\b|belum diisi|belum tersedia/i', $value)
            ? trim($value)
            : null;

        $mapUrl = $availableText($profile?->map_url);
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
            'phone' => $availableText($profile?->phone),
            'whatsapp' => $availableText($profile?->whatsapp),
            'email' => $availableText($profile?->email),
            'office_hours' => $availableText($profile?->office_hours),
            'map_url' => $mapUrl,
        ];

        return view('pages.kontak', compact('kontak'));
    }
}