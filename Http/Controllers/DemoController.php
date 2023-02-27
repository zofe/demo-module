<?php

namespace App\Modules\Demo\Http\Controllers;


use App\Modules\Demo\Database\Seeders\DemoSeeder;
use Faker\Factory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class DemoController extends Controller
{
    public function __construct()
    {
        view()->share('db_filled', Schema::hasTable('demo_articles'));
    }

    public function index()
    {
        return view('demo::frontend');
    }

    public function schema()
    {
        DB::table('demo_authors')->truncate();
        DB::table('demo_articles')->truncate();
        Artisan::call('db:seed', ['--class' => DemoSeeder::class, '--no-interaction' => true]);

        session()->flash('message', 'Database populated');

        return view('demo::frontend');
    }


}
