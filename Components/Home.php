<?php

namespace App\Modules\Demo\Components;


use App\Modules\Demo\Database\Seeders\DemoSeeder;
use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use App\Modules\Knowledgebase\Models\Tag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;


class Home extends Component
{
    use WithDataTable;

    public $db_filled;

    public function mount()
    {
        $this->db_filled=Schema::hasTable('demo_articles');
    }

    public function render()
    {
        return view("demo::views.demo")->layout('demo::frontend');
    }

    public function populate()
    {
        DB::table('demo_authors')->truncate();
        DB::table('demo_articles')->truncate();
        Artisan::call('db:seed', ['--class' => DemoSeeder::class, '--no-interaction' => true]);

        session()->flash('message', 'Database populated');
        return redirect()->to(route('demo'));
    }
}
