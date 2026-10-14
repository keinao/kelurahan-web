<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ExportSiteCommand extends Command
{
    protected $signature = 'site:export';
    protected $description = 'Export seluruh halaman profil kelurahan ke HTML statis (dist/) untuk hosting Vercel/Netlify';

    public function handle(): int
    {
        $this->info('=====================================================');
        $this->info('  Memulai Export Website Profil Kelurahan Kinilow   ');
        $this->info('=====================================================');

        // Pastikan build Vite sudah ada
        if (! File::exists(public_path('build/manifest.json'))) {
            $this->warn('Aset Vite belum di-build. Menjalankan "npm run build"...');
            exec('npm run build');
        }

        $distPath = base_path('dist');

        // Bersihkan folder dist sebelumnya jika ada
        if (File::exists($distPath)) {
            File::deleteDirectory($distPath);
        }
        File::makeDirectory($distPath, 0755, true);

        // Ubah config app.url menjadi path root kosong agar asset() dan route() menghasilkan URL relatif
        config(['app.url' => '']);

        // Salin semua aset publik (CSS, JS, Gambar, Font, Favicon)
        $this->info('Menyalin aset publik (images, build, fonts, favicon)...');
        $this->copyPublicAssets(public_path(), $distPath);

        // Daftar rute utama yang akan diexport
        $this->info('Merender halaman ke HTML statis...');

        $pages = [
            '/' => ['index.html'],
            '/tentang' => ['tentang/index.html', 'tentang.html'],
            '/informasi' => ['informasi/index.html', 'informasi.html'],
            '/galeri' => ['galeri/index.html', 'galeri.html'],
            '/fasilitas' => ['fasilitas/index.html', 'fasilitas.html'],
            '/anggota-kkt' => ['anggota-kkt/index.html', 'anggota-kkt.html'],
            '/kontak' => ['kontak/index.html', 'kontak.html'],
        ];

        // Tambahkan setiap artikel berita publik
        try {
            $allNews = News::published()
                ->where('content', 'not like', '%[DATA CONTOH]%')
                ->get();

            foreach ($allNews as $newsItem) {
                $pages['/informasi/' . $newsItem->slug] = [
                    "informasi/{$newsItem->slug}/index.html",
                    "informasi/{$newsItem->slug}.html",
                ];
            }
        } catch (\Throwable $e) {
            $this->warn('Catatan berita dinamis: ' . $e->getMessage());
        }

        // Render setiap halaman dengan full Route::dispatch agar request()->routeIs() bekerja sempurna
        foreach ($pages as $uri => $outputFiles) {
            try {
                $html = $this->renderUri($uri);
                foreach ($outputFiles as $outputFile) {
                    $this->savePage($distPath, $outputFile, $html);
                }
            } catch (\Throwable $e) {
                $this->error("Gagal render [$uri]: " . $e->getMessage());
            }
        }

        // Buat halaman redirect statis untuk alias rute
        $this->createRedirectPage($distPath, 'statistik', '/tentang#statistik');
        $this->createRedirectPage($distPath, 'profil', '/tentang');
        $this->createRedirectPage($distPath, 'pemerintahan', '/tentang#struktur-pemerintahan');
        $this->createRedirectPage($distPath, 'potensi', '/');

        $this->info('=====================================================');
        $this->info('  Export Selesai! Folder "dist/" siap di-deploy ke Vercel.');
        $this->info('=====================================================');

        return Command::SUCCESS;
    }

    private function renderUri(string $uri): string
    {
        $request = Request::create($uri, 'GET');
        app()->instance('request', $request);

        $response = Route::dispatch($request);
        $html = $response->getContent();

        // Bersihkan semua prefix localhost agar menjadi URL relatif yang bekerja di domain apa pun di Vercel
        $html = str_replace([
            'http://localhost:8000',
            'http://127.0.0.1:8000',
            'https://localhost:8000',
            'http://localhost',
            'http://127.0.0.1',
        ], '', $html);

        // Pastikan link beranda kosong href="" menjadi href="/"
        $html = preg_replace('/href=""/', 'href="/"', $html);

        return $html;
    }

    private function savePage(string $distPath, string $relativePath, string $html): void
    {
        $targetFile = $distPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        File::ensureDirectoryExists(dirname($targetFile));
        File::put($targetFile, $html);
        $this->line("  [OK] -> {$relativePath}");
    }

    private function createRedirectPage(string $distPath, string $alias, string $targetUrl): void
    {
        $redirectHtml = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0; url={$targetUrl}">
    <link rel="canonical" href="{$targetUrl}">
    <title>Mengalihkan...</title>
</head>
<body>
    <p>Mengalihkan ke <a href="{$targetUrl}">{$targetUrl}</a>...</p>
</body>
</html>
HTML;

        $this->savePage($distPath, "{$alias}/index.html", $redirectHtml);
        $this->savePage($distPath, "{$alias}.html", $redirectHtml);
    }

    private function copyPublicAssets(string $source, string $destination): void
    {
        $directories = ['images', 'build', 'fonts', 'css', 'js'];
        foreach ($directories as $dir) {
            $srcDir = $source . DIRECTORY_SEPARATOR . $dir;
            $dstDir = $destination . DIRECTORY_SEPARATOR . $dir;
            if (File::isDirectory($srcDir)) {
                File::copyDirectory($srcDir, $dstDir);
            }
        }

        $rootFiles = File::files($source);
        foreach ($rootFiles as $file) {
            $filename = $file->getFilename();
            if ($filename === 'storage' || is_dir($file->getPathname()) || is_link($file->getPathname())) {
                continue;
            }
            if (str_ends_with($filename, '.php') || str_starts_with($filename, '.htaccess') || $filename === 'hot') {
                continue;
            }
            File::copy($file->getPathname(), $destination . DIRECTORY_SEPARATOR . $filename);
        }

        if (File::isDirectory(storage_path('app/public'))) {
            File::copyDirectory(storage_path('app/public'), $destination . DIRECTORY_SEPARATOR . 'storage');
        }
    }
}
