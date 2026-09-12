<?php

namespace App\Modules\Demo\Livewire;

use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;

class ArticlesTable extends Component
{
    use WithDataTable;

    public string $search = '';

    public ?int $author_id = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedAuthorId(): void
    {
        $this->resetPage();
    }

    public function getDataSet()
    {
        return Article::ssearch($this->search)
            ->with('author')
            ->when($this->author_id, fn ($q) => $q->where('author_id', $this->author_id))
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('demo::articles_table', [
            'items' => $this->getDataSet(),
            'authors' => Author::query()->orderBy('firstname')->pluck('firstname', 'id')->toArray(),
        ])->layout('layout::admin');
    }
}
