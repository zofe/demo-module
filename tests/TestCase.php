<?php

namespace App\Modules\Demo\Tests;

use App\Modules\Demo\DemoModuleServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Zofe\Rapyd\RapydServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('view:clear');
    }

    protected function getPackageProviders($app)
    {
        return [
            RapydServiceProvider::class,
            LivewireServiceProvider::class,
            \Lab404\Impersonate\ImpersonateServiceProvider::class,
            DemoModuleServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        // The users table of the host app (uuid keys, as rpd:install --uuid-users creates them).
        $this->app['migrator']->path(__DIR__ . '/database/migrations');
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', ['driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '']);
        $app['config']->set('session.driver', 'array');
        $app['config']->set('auth.providers.users.model', Models\User::class);
        $app['config']->set('rapyd.search.models', []);
    }
}
