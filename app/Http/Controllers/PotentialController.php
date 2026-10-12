<?php

namespace App\Http\Controllers;

use App\Models\Potential;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class PotentialController extends Controller
{
    public function index(): View
    {
        $potensi = $this->publicPotentials()
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->paginate(9);

        return view('pages.potensi.index', compact('potensi'));
    }

    public function show(string $slug): View
    {
        $potensi = $this->publicPotentials()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.potensi.show', compact('potensi'));
    }

    private function publicPotentials(): Builder
    {
        return Potential::active()
            ->whereRaw('LOWER(name) NOT LIKE ?', ['%contoh%'])
            ->where(function (Builder $query): void {
                $query->whereNull('description')
                    ->orWhere('description', 'not like', '%[DATA CONTOH]%');
            });
    }
}