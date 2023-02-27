<?php

namespace App\Modules\Demo\Components\Articles;

use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use Livewire\Component;



class ArticlesEdit extends Component
{
    public $article;

    protected $rules = [
        'article.title'   => 'required',
        'article.author_id'=> 'required',
        'article.body'    => 'nullable',
        'article.public'  => 'nullable|boolean',
    ];

    public function mount(?Article $article)
    {
        $this->article = $article;
    }

    public function save()
    {
        $this->validate();
        $this->article->save();

        return redirect()->to(route('demo.articles.view', $this->article->getKey()));
    }

    public function render()
    {
        $authors = Author::all()->pluck('firstname', 'id')->toArray();

        return view('demo::Articles.views.articles_edit', compact('authors'))->layout('demo::admin');
    }
}
