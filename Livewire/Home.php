<?php

namespace App\Modules\Demo\Livewire;

use App\Modules\Demo\Database\Seeders\DemoSeeder;
use App\Modules\Demo\Models\Article;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Home extends Component
{
    public bool $db_filled = false;

    public function mount(): void
    {
        $this->db_filled = Article::query()->exists();
    }

    public function populate()
    {
        Artisan::call('db:seed', ['--class' => DemoSeeder::class, '--no-interaction' => true]);

        session()->flash('message', 'Demo data (re)populated.');

        return redirect()->to(route('demo'));
    }

    public function render()
    {
        return view('demo::home')->layout('layout::admin');
    }
}
