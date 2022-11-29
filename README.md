# Demo Module

this is a demo module for a Laravel application (>= 8) that show a minimal "articles CRUD" in the rapyd-livewire stack


# Rapyd livewire
[rapyd-livewire](https://github.com/zofe/rapyd-livewire) is a laravel library of blade components, livewire traits, and modules scaffolder that you can use to generate administration interfaces in a concise, reusable, uncluttered, and testable manner.


# Installation 

Your laravel application must have rapyd-livewire package already installed first, then you can require this module using: 
```
composer require zofe/rapyd-module-installer zofe/demo-module
```

This command will create a folder "Demo" in your /app/Modules/ folder, then a demo will be enabled in (check `/demo/` path)

This is also a demonstration about how you can publish custom isolated modules in you laravel-rapyd stack, using:
- github 
- [packagist](https://packagist.org/) (submitting as normal dependency) 
- and composer as installer


Note: you can achieve something similar using only composer and vcs declaration in your laravel composer.json file e.g.:

```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/my-nick/my-module"
        }
    ],
    "require": {
        "my-nick/my-module": "^1.0",
        ...
```
but the purpose of rapyd modules / rapyd module installer is to give you an application bootstrap that you must customize in your application main repo.

