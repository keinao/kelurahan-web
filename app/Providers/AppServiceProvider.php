<?php

namespace App\Providers;

use App\Models\VillageProfile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Profil kelurahan dibagikan ke layout publik. Navbar dan footer
        // di-include dari layout, sehingga mewarisi variabel ini dan query
        // hanya berjalan satu kali per halaman. Query berjalan saat layout
        // dirender, bukan saat boot, jadi perintah artisan (misalnya migrate)
        // tidak menyentuh tabel ini.
        View::composer('layouts.app', function ($view): void {
            $view->with('villageProfile', VillageProfile::query()->first());
        });
    }
}