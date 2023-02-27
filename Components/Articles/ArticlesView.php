<?php

namespace App\Modules\Demo\Components\Articles;

use App\Modules\Demo\Models\Article;
use Livewire\Component;


class ArticlesView extends Component
{
    public $article;

    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function render()
    {
        return view('demo::Articles.views.articles_view')->layout('demo::admin');
    }
}
