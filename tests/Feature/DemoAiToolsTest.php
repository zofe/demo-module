<?php

namespace App\Modules\Demo\Tests\Feature;

use App\Modules\Demo\Ai\DemoAiToolProvider;
use App\Modules\Demo\Database\Seeders\DemoSeeder;
use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use App\Modules\Demo\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Zofe\Rapyd\Contracts\AiTool;

/**
 * The two tools the AI assistant may use on the demo: a search over the articles and the
 * numbers of the demo. They hand back titles, names, dates and links, never a body.
 */
class DemoAiToolsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DemoSeeder::class);
    }

    protected function tool(string $name): AiTool
    {
        foreach ((new DemoAiToolProvider())->tools() as $tool) {
            if ($tool->name === $name) {
                return $tool;
            }
        }
        $this->fail("tool {$name} not declared");
    }

    public function test_the_provider_declares_the_two_tools_with_a_schema_the_providers_accept()
    {
        $names = array_map(fn ($tool) => $tool->name, (new DemoAiToolProvider())->tools());
        $this->assertSame(['demo_search_articles', 'demo_overview'], $names);

        // "properties" must encode as a JSON object even when there is none
        $this->assertStringContainsString('"properties":{}', json_encode($this->tool('demo_overview')->toDefinition()));
    }

    public function test_the_search_finds_by_title_and_by_author_and_returns_a_window_without_the_body()
    {
        $author = Author::create(['firstname' => 'Ada', 'lastname' => 'Lovelace']);
        $article = Article::create(['author_id' => $author->id, 'title' => 'The analytical engine', 'body' => 'Secret body text', 'public' => true, 'publication_date' => '2026-01-15']);
        Article::create(['author_id' => $author->id, 'title' => 'Notes', 'body' => 'about Bernoulli numbers', 'public' => false, 'publication_date' => '2026-02-01']);

        $byTitle = $this->tool('demo_search_articles')->execute(['query' => 'analytical']);
        $this->assertSame(1, $byTitle['found']);
        $this->assertSame('The analytical engine', $byTitle['articles'][0]['title']);
        $this->assertSame('Ada Lovelace', $byTitle['articles'][0]['author']);
        $this->assertSame('2026-01-15', $byTitle['articles'][0]['published_on']);
        $this->assertSame('public', $byTitle['articles'][0]['status']);
        $this->assertStringEndsWith('/demo/articles/view/' . $article->id, $byTitle['articles'][0]['url']);
        $this->assertStringNotContainsString('Secret body text', json_encode($byTitle), 'the body stays in the application');

        $byBody = $this->tool('demo_search_articles')->execute(['query' => 'bernoulli']);
        $this->assertSame('draft', $byBody['articles'][0]['status']);

        $byAuthor = $this->tool('demo_search_articles')->execute(['author' => 'lovelace', 'limit' => 50]);
        $this->assertSame(2, $byAuthor['found'], 'both articles of the author');
        $this->assertSame('Notes', $byAuthor['articles'][0]['title'], 'newest first');

        $latest = $this->tool('demo_search_articles')->execute(['limit' => 3]);
        $this->assertCount(3, $latest['articles'], 'no query: the latest articles, the limit respected');

        $capped = $this->tool('demo_search_articles')->execute(['limit' => 50]);
        $this->assertLessThanOrEqual(DemoAiToolProvider::MAX_RESULTS, count($capped['articles']));
    }

    public function test_the_overview_counts_the_demo_and_names_the_latest_article_and_the_busiest_author()
    {
        Article::query()->update(['public' => true]);
        $author = Author::create(['firstname' => 'Ada', 'lastname' => 'Lovelace']);
        for ($i = 1; $i <= 30; $i++) {
            Article::create(['author_id' => $author->id, 'title' => "Note {$i}", 'body' => '...', 'public' => $i > 28, 'publication_date' => '2030-01-0' . min($i, 9)]);
        }

        $overview = $this->tool('demo_overview')->execute([]);
        $this->assertSame(Article::count(), $overview['articles']);
        $this->assertSame(Article::count() - 28, $overview['public']);
        $this->assertSame(28, $overview['drafts']);
        $this->assertSame(Author::count(), $overview['authors']);
        $this->assertSame('Ada Lovelace', $overview['author_with_most_articles']['name']);
        $this->assertSame(30, $overview['author_with_most_articles']['articles']);
        $this->assertSame('2030-01-09', $overview['latest_public_article']['published_on']);
        $this->assertSame('public', $overview['latest_public_article']['status']);
        $this->assertStringEndsWith('/demo/articles', $overview['table_url']);
    }
}
