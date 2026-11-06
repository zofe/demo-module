<?php

namespace App\Modules\Demo;

use App\Modules\Demo\Ai\DemoAiToolProvider;
use Zofe\Rapyd\Modules\RapydModuleServiceProvider;

/**
 * A module packaged on its own: same folder layout as a module generated in
 * app/Modules, plus this provider. bootAppModule() loads migrations, views,
 * routes and the "demo::" Livewire components; config.php is merged as
 * config('demo'). Copy the folder to app/Modules/Demo and it keeps working
 * (isEjected() steps aside, the app's ModuleServiceProvider takes over).
 */
class DemoModuleServiceProvider extends RapydModuleServiceProvider
{
    protected string $moduleName = 'Demo';

    protected ?string $modulePath = __DIR__;

    public function boot(): void
    {
        if ($this->isEjected()) {
            return;
        }

        $this->bootAppModule('demo');

        // What the AI assistant may read of the demo (two tools over articles and authors),
        // when ai-module is installed. Offered to the visitors only with AI_WIDGET_GUEST_TOOLS=demo_*.
        if (class_exists(\Zofe\Ai\AiRegistry::class)) {
            \Zofe\Ai\AiRegistry::register(new DemoAiToolProvider());
        }
    }
}
