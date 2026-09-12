# Rapyd Admin — Demo module

The self-documenting CRUD demo of [Rapyd Admin](https://github.com/zofe/rapyd-admin): a table, a detail page and a
form for *Articles* by *Authors*. Every page shows, right under it, the route, the Livewire component and the Blade
view that produce it, so you see how little a CRUD takes. It is also the reference for **a module packaged on its
own**: same folder layout as a module generated in `app/Modules`, plus `composer.json`, a provider and tests.

Live: [rapyd.dev/demo](https://rapyd.dev/demo)

## Install

```bash
composer require zofe/demo-module
php artisan migrate
```

Open `/demo` and click **Populate the database** (or `php artisan db:seed --class="App\\Modules\\Demo\\Database\\Seeders\\DemoSeeder"`).
A "Crud Demo" entry appears in the sidebar. The pages are public on purpose: it is a showcase.

## What to look at

```
demo-module/
├─ Livewire/       Home, ArticlesTable, ArticlesView, ArticlesEdit
├─ Views/          home, articles_table, articles_view, articles_edit, menu, folders
├─ Models/         Article (SSearch), Author
├─ Database/       migrations (demo_articles, demo_authors) and the seeder
├─ config.php      layout, sidebar entry
├─ routes.php
├─ DemoModuleServiceProvider.php   extends RapydModuleServiceProvider, $modulePath = __DIR__
└─ tests/          Testbench + Livewire tests of the three pages
```

- `ArticlesTable`: `WithDataTable`, search through the `SSearch` trait, an author filter, sorting and pagination in a
  `x-rpd::table`.
- `ArticlesEdit`: a `x-rpd::edit` form bound to the model, `$rules` as the single source of validation and of the
  fields kept between requests, `x-rpd::rich-text` for the body.
- `Documenter`: prints the source of a file (or a route matched by a regex) with the documentation block stripped.
- Copy the folder to `app/Modules/Demo` and it keeps working as an app module: the provider steps aside.

## Tests

```bash
composer install
composer test
```
