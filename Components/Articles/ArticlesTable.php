<?php

namespace App\Modules\Demo\Components\Articles;

use App\Models\Author;
use Livewire\Component;
use App\Modules\Demo\Models\Article;
use Zofe\Rapyd\Traits\WithDataTable;

class ArticlesTable extends Component
{
    use WithDataTable;
    public $search;
    public $author_id;

    public function updatedAuthorId()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getDataSet()
    {
        $items = Article::ssearch($this->search);

        if ($this->author_id) {
            $items = $items->where('author_id','=',$this->author_id);
        }

        return $items = $items
            ->orderBy($this->sortField,$this->sortAsc ?'asc':'desc')
            ->paginate($this->perPage)
            ;
    }

    public function render()
    {
        $items = $this->getDataSet();
        $authors = Author::all()->pluck('firstname','id')->toArray();


        return view('demo::Articles.views.articles_table',
                    compact('items','authors')
        );
    }
}
