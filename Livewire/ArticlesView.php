<?php

namespace App\Modules\Demo\Livewire;

use App\Modules\Demo\Models\Article;
use Livewire\Component;

class ArticlesView extends Component
{
    public Article $article;

    public function mount(Article $article): void
    {
        $this->article = $article;
    }

    public function render()
    {
        return view('demo::articles_view')->layout('layout::admin');
    }
}
