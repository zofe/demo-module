<?php

namespace App\Modules\Demo\Ai;

use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use Zofe\Rapyd\Contracts\AiTool;
use Zofe\Rapyd\Contracts\AiToolProvider;

/**
 * What the AI assistant may read of the demo: two tools over the articles and the authors,
 * and nothing else. They return titles, names, dates and links, never the body of an
 * article, never anything outside demo_articles and demo_authors. Registered by the
 * provider when ai-module is installed; the application opens them to the visitors with
 * AI_WIDGET_GUEST_TOOLS=demo_* (see the README of ai-module).
 */
class DemoAiToolProvider implements AiToolProvider
{
    public const MAX_RESULTS = 10;

    public function tools(): array
    {
        return [
            new AiTool(
                name: 'demo_search_articles',
                description: 'Searches the articles of the demo by a word in the title or the body, and/or by the name of the author. Returns the title, the author, the publication date, whether the article is public or a draft, and the link to its page in the demo (not the body). Use it when someone asks what the demo contains, what an author wrote, or whether there is an article about something.',
                inputSchema: [
                    'type' => 'object',
                    'properties' => [
                        'query' => ['type' => 'string', 'description' => 'A word or phrase to look for in the title or the body. Omit it to list the latest articles.'],
                        'author' => ['type' => 'string', 'description' => 'The first or last name of the author, or part of it.'],
                        'limit' => ['type' => 'integer', 'default' => 5, 'description' => 'How many articles to return, ' . self::MAX_RESULTS . ' at most.'],
                    ],
                ],
                handler: fn (array $input) => $this->search(
                    isset($input['query']) ? trim((string) $input['query']) : null,
                    isset($input['author']) ? trim((string) $input['author']) : null,
                    (int) ($input['limit'] ?? 5),
                ),
            ),
            new AiTool(
                name: 'demo_overview',
                description: 'Returns the numbers of the demo: how many articles and authors there are, how many articles are public and how many are drafts, the latest public article and the author with the most articles, with the link to the articles table. Use it when someone asks what is in the demo or how big it is.',
                inputSchema: ['type' => 'object', 'properties' => new \stdClass()],
                handler: fn () => $this->overview(),
            ),
        ];
    }

    /** The articles that match, newest first: a window of titles, names, dates and links. */
    protected function search(?string $query, ?string $author, int $limit): array
    {
        $articles = Article::query()->with('author')
            ->when($query, fn ($q) => $q->where(fn ($w) => $w->where('title', 'like', '%' . $query . '%')->orWhere('body', 'like', '%' . $query . '%')))
            ->when($author, fn ($q) => $q->whereHas('author', fn ($a) => $a->where('firstname', 'like', '%' . $author . '%')->orWhere('lastname', 'like', '%' . $author . '%')))
            ->orderByDesc('publication_date')->orderByDesc('id')
            ->limit(max(1, min($limit, self::MAX_RESULTS)))
            ->get();

        return [
            'found' => $articles->count(),
            'articles' => $articles->map(fn (Article $article) => $this->row($article))->values()->all(),
            'table_url' => route_lang('demo.articles'),
        ];
    }

    /** The numbers of the demo, with the two records a visitor would ask about first. */
    protected function overview(): array
    {
        $latest = Article::query()->with('author')->where('public', true)->orderByDesc('publication_date')->orderByDesc('id')->first();
        $top = Author::query()->withCount('articles')->orderByDesc('articles_count')->orderBy('lastname')->first();

        return [
            'articles' => Article::query()->count(),
            'public' => Article::query()->where('public', true)->count(),
            'drafts' => Article::query()->where('public', false)->count(),
            'authors' => Author::query()->count(),
            'latest_public_article' => $latest ? $this->row($latest) : null,
            'author_with_most_articles' => $top ? ['name' => trim($top->firstname . ' ' . $top->lastname), 'articles' => $top->articles_count] : null,
            'table_url' => route_lang('demo.articles'),
        ];
    }

    protected function row(Article $article): array
    {
        return [
            'title' => $article->title,
            'author' => $article->author ? trim($article->author->firstname . ' ' . $article->author->lastname) : null,
            'published_on' => $article->publication_date?->toDateString(),
            'status' => $article->public ? 'public' : 'draft',
            'url' => route_lang('demo.articles.view', $article),
        ];
    }
}
