<?php

namespace App\Modules\Demo\Tests\Feature;

use App\Modules\Demo\Database\Seeders\DemoSeeder;
use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use App\Modules\Demo\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Livewire\Livewire;

class DemoTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DemoSeeder::class);
    }

    public function test_home_offers_the_table_when_data_exists()
    {
        Livewire::test('demo::home')->assertSet('db_filled', true)->assertSee('Open the articles table');
    }

    public function test_home_populates_an_empty_database()
    {
        Article::query()->delete();
        Author::query()->delete();

        Livewire::test('demo::home')
            ->assertSet('db_filled', false)
            ->call('populate')
            ->assertRedirect(route('demo'));

        $this->assertSame(10, Author::count());
        $this->assertSame(20, Article::count());
    }

    public function test_repopulate_replaces_the_data_instead_of_adding_to_it()
    {
        $before = Article::orderBy('id')->pluck('id')->all();

        Livewire::test('demo::home')->call('populate');

        $this->assertSame(10, Author::count());
        $this->assertSame(20, Article::count());
        $this->assertEmpty(array_intersect($before, Article::pluck('id')->all()), 'old rows are gone');
        $this->assertSame(0, Article::whereNotIn('author_id', Author::pluck('id'))->count(), 'every article has a living author');
    }

    public function test_table_searches_and_filters_by_author()
    {
        $article = Article::orderByDesc('id')->first();   // on the first page (sorted by id desc)
        $author = $article->author;
        $article->update(['title' => 'Unmistakable title']);

        Livewire::test('demo::articles-table')
            ->assertSee('Unmistakable title')
            ->set('search', 'Unmistakable')
            ->assertSee('Unmistakable title')
            ->set('search', '')
            ->set('author_id', $author->id)
            ->assertSee($author->firstname);
    }

    public function test_view_shows_the_article()
    {
        $article = Article::first();

        Livewire::test('demo::articles-view', ['article' => $article])
            ->assertSee($article->title)
            ->assertSee($article->author->firstname);
    }

    public function test_edit_validates_and_saves()
    {
        Livewire::test('demo::articles-edit')
            ->set('article.title', '')
            ->call('save')
            ->assertHasErrors(['article.title' => 'required', 'article.author_id' => 'required', 'article.publication_date' => 'required']);

        $author = Author::first();

        Livewire::test('demo::articles-edit')
            ->set('article.title', 'Written from the test')
            ->set('article.author_id', $author->id)
            ->set('article.body', '<p>Body</p>')
            ->set('article.publication_date', '2026-09-12')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('demo_articles', ['title' => 'Written from the test', 'author_id' => $author->id]);
    }

    public function test_the_demo_is_listed_in_both_menus()
    {
        $this->assertContains('demo::menu', config('rapyd.menus.admin'));
        $this->assertContains('demo::frontend_menu', config('rapyd.menus.frontend'));
        $this->get(route('demo'))->assertOk()->assertSee('Crud Demo');
    }

    public function test_pages_render_inside_the_admin_layout_without_login()
    {
        $this->get(route('demo'))->assertOk()->assertSee('Rapyd CRUD demo');
        $this->get(route('demo.articles'))->assertOk()->assertSee('module structure');
        $this->get(route('demo.articles.edit'))->assertOk()->assertSee('Article');
    }
}
