<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsPublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_information_index_shows_only_published_records(): void
    {
        $published = News::factory()->published()->create([
            'title' => 'Informasi Resmi Tampil',
            'content' => '<p>Ringkasan resmi yang aman.</p>',
        ]);
        News::factory()->draft()->create(['title' => 'Draft Jangan Tampil']);
        News::factory()->published()->create([
            'title' => 'Informasi Contoh dari Seeder',
            'content' => '<p>[DATA CONTOH] Konten seed tidak untuk publik.</p>',
        ]);
        News::factory()->published()->create([
            'title' => 'Jadwal Mendatang',
            'published_at' => now()->addDay(),
        ]);

        $this->get(route('informasi.index'))
            ->assertOk()
            ->assertSee($published->title)
            ->assertSee('Ringkasan resmi yang aman.')
            ->assertDontSee('Draft Jangan Tampil')
            ->assertDontSee('Informasi Contoh dari Seeder')
            ->assertDontSee('Jadwal Mendatang');
    }

    public function test_information_index_filters_each_supported_category(): void
    {
        foreach (News::CATEGORIES as $category => $label) {
            News::factory()->published()->create([
                'category' => $category,
                'title' => 'Judul '.$category,
                'content' => '<p>Isi kategori '.$label.'</p>',
            ]);
        }

        foreach (News::CATEGORIES as $category => $label) {
            $response = $this->get(route('informasi.index', ['kategori' => $category]))
                ->assertOk()
                ->assertSee('Judul '.$category)
                ->assertSee($label);

            foreach (array_diff(array_keys(News::CATEGORIES), [$category]) as $otherCategory) {
                $response->assertDontSee('Judul '.$otherCategory);
            }
        }
    }

    public function test_invalid_information_category_returns_validation_error(): void
    {
        $this->from(route('informasi.index'))
            ->get(route('informasi.index', ['kategori' => 'tidak-valid']))
            ->assertRedirect(route('informasi.index'))
            ->assertSessionHasErrors('kategori');
    }

    public function test_information_index_paginates_and_keeps_filter_query(): void
    {
        foreach (range(1, 10) as $number) {
            News::factory()->published()->create([
                'category' => 'berita',
                'title' => 'Berita '.$number,
                'content' => '<p>Isi berita '.$number.'</p>',
                'published_at' => now()->subDays($number),
            ]);
        }

        $this->get(route('informasi.index', ['kategori' => 'berita']))
            ->assertOk()
            ->assertSee('Berita 1')
            ->assertDontSee('Berita 10')
            ->assertSee('page=2')
            ->assertSee('kategori=berita');

        $this->get(route('informasi.index', ['kategori' => 'berita', 'page' => 2]))
            ->assertOk()
            ->assertSee('Berita 10');
    }

    public function test_information_detail_renders_allowed_formatting_and_sanitizes_unsafe_markup(): void
    {
        $news = News::factory()->published()->create([
            'title' => 'Artikel Terbit',
            'content' => '<p>Isi yang benar.</p><h2>Subjudul</h2><script>alert(1)</script><p><a href="javascript:alert(2)">tautan</a></p>',
        ]);

        $this->get(route('informasi.show', $news->slug))
            ->assertOk()
            ->assertSee('Artikel Terbit')
            ->assertSee('Berita')
            ->assertSee('Isi yang benar.')
            ->assertSee('<h2>Subjudul</h2>', false)
            ->assertDontSee('alert(1)', false)
            ->assertDontSee('javascript:', false);
    }

    public function test_draft_future_and_missing_information_details_return_404(): void
    {
        $draft = News::factory()->draft()->create();
        $future = News::factory()->published()->create(['published_at' => now()->addDay()]);
        $sample = News::factory()->published()->create([
            'title' => 'Informasi Contoh Detail',
            'slug' => 'informasi-contoh-detail',
            'content' => '<p>[DATA CONTOH] Konten seed.</p>',
        ]);

        $this->get(route('informasi.show', $draft->slug))->assertNotFound();
        $this->get(route('informasi.show', $future->slug))->assertNotFound();
        $this->get(route('informasi.show', $sample->slug))->assertNotFound();
        $this->get(route('informasi.show', 'slug-yang-tidak-ada'))->assertNotFound();
    }

    public function test_empty_information_list_and_filtered_empty_state_are_successful(): void
    {
        $this->get(route('informasi.index'))
            ->assertOk()
            ->assertSee('Belum ada informasi publik yang ditampilkan.');

        $this->get(route('informasi.index', ['kategori' => 'kegiatan']))
            ->assertOk()
            ->assertSee('Belum ada informasi terbit dalam kategori Kegiatan.');
    }

    public function test_home_and_profile_routes_still_respond_successfully(): void
    {
        $this->get(route('beranda'))->assertOk();
        $this->get(route('profil'))->assertOk();
    }
}