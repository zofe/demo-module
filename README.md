# Demo Module

This is a demo module for a Laravel application (>= 8) 

Demo show "CRUD" features in the laravel / rapyd-livewire stack.  
[rapyd-livewire](https://github.com/zofe/rapyd-livewire) is a laravel library of blade components, livewire traits, and modules scaffolder that you can use to generate administration interfaces in a concise, reusable, uncluttered, and testable manner.


# Installation & configuration 

Your can require this module in your laravel application using:
```
composer require zofe/demo-module

php artisan migrate 
php artisan db:seed --class="App\\Modules\\Demo\\Database\\Seeders\\DemoSeeder"
```
Note that demo module use layout-module, you may need to do:

```
cd app/Modules/Layout/

npm i
npm run dev
```

this will compile scss and copy css assets to your public project folder


# Usage
This command will create a folder "Demo" in your /app/Modules/ folder,   
then a demo will be enabled in `/demo` route

