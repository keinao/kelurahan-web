<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'kategori' => ['nullable', 'string', Rule::in(array_keys(News::CATEGORIES))],
        ]);

        $kategori = $validated['kategori'] ?? null;

        $berita = News::published()
            ->where('content', 'not like', '%[DATA CONTOH]%')
            ->when($kategori, fn ($query) => $query->where('category', $kategori))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        $berita->getCollection()->transform(function (News $item): News {
            $content = preg_replace('/<(script|style)\b[^>]*>.*?<\/\1>/is', ' ', $item->content) ?? '';
            $text = html_entity_decode(strip_tags($content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $text = preg_replace('/\s+/u', ' ', trim($text)) ?? '';

            $item->setAttribute('summary', Str::limit($text, 180));

            return $item;
        });

        return view('pages.informasi.index', compact('berita', 'kategori'));
    }

    public function show(string $slug): View
    {
        // Scope published menyembunyikan draft dan jadwal terbit yang belum tiba.
        $berita = News::published()
            ->where('content', 'not like', '%[DATA CONTOH]%')
            ->where('slug', $slug)
            ->firstOrFail();

        $config = (new HtmlSanitizerConfig())
            ->allowElement('p')
            ->allowElement('br')
            ->allowElement('strong')
            ->allowElement('b')
            ->allowElement('em')
            ->allowElement('i')
            ->allowElement('u')
            ->allowElement('s')
            ->allowElement('del')
            ->allowElement('h2')
            ->allowElement('h3')
            ->allowElement('blockquote')
            ->allowElement('ul')
            ->allowElement('ol')
            ->allowElement('li')
            ->allowElement('a', ['href', 'title'])
            ->allowRelativeLinks();

        $isiAman = (new HtmlSanitizer($config))->sanitize($berita->content);

        return view('pages.informasi.show', compact('berita', 'isiAman'));
    }
}