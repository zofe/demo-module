<?php

namespace App\Modules\Demo\Livewire;

use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use Livewire\Component;

class ArticlesEdit extends Component
{
    public Article $article;

    // Fields bound with x-rpd:: components: also what survives between requests
    // on a model that is not saved yet.
    protected $rules = [
        'article.title'     => 'required',
        'article.author_id' => 'required|exists:demo_authors,id',
        'article.body'      => 'nullable',
        'article.public'    => 'nullable|boolean',
        'article.publication_date' => 'required|date',
    ];

    public function mount(?Article $article = null): void
    {
        $this->article = $article ?? new Article();
    }

    public function save()
    {
        $this->validate();
        $this->article->save();

        return redirect()->to(route('demo.articles.view', $this->article->getKey()));
    }

    public function render()
    {
        return view('demo::articles_edit', [
            'authors' => Author::query()->orderBy('firstname')->pluck('firstname', 'id')->toArray(),
        ])->layout('layout::admin');
    }
}
