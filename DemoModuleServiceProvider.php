<?php

namespace App\Modules\Demo;

use Illuminate\Support\ServiceProvider;

class DemoModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'demo');
    }

    public function boot(): void
    {
        // ModuleServiceProvider handles everything when the module is ejected to app/Modules/Demo/
        if ($this->isEjected()) {
            return;
        }

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->loadViewsFrom(__DIR__ . '/Views', 'demo');
        $this->loadViewsFrom(__DIR__ . '/Components', 'demo');

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/Components/routes.php');

    }

    protected function isEjected(): bool
    {
        return is_dir(app_path('Modules/Demo'));
    }
}
