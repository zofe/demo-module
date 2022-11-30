# Demo Module

This is a demo module for a Laravel application (>= 8) that show a minimal "articles CRUD" in the rapyd-livewire stack.  
[rapyd-livewire](https://github.com/zofe/rapyd-livewire) is a laravel library of blade components, livewire traits, and modules scaffolder that you can use to generate administration interfaces in a concise, reusable, uncluttered, and testable manner.


# Installation & configuration 

Your laravel application must have rapyd-livewire package already installed first, then you can require this module using: 
```
composer require zofe/rapyd-module-installer zofe/demo-module

php artisan migrate 
php artisan db:seed --class="App\\Modules\\Demo\\Database\\Seeders\\DemoSeeder"
```

Please ensure that you have a `livewire.php` config file in your laravel config folder.  
It's important to define the application layout file.  
Use this configuration for example:
```
<?php
#/config/livewire.php

return [
    'class_namespace' => 'App\\Http\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'layout' => 'demo::layouts.app',
    'asset_url' => null,
    'app_url' => null,
    'middleware_group' => 'web',
    'manifest_path' => null,
    'back_button_cache' => false,
    'render_on_redirect' => false,

];
```

# Usage
This command will create a folder "Demo" in your /app/Modules/ folder, then a demo will be enabled in `/demo/` route

