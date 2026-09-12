<?php

use App\Modules\Demo\Livewire\ArticlesEdit;
use App\Modules\Demo\Livewire\ArticlesTable;
use App\Modules\Demo\Livewire\ArticlesView;
use App\Modules\Demo\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('demo', Home::class)
    ->middleware(['web'])
    ->name('demo')
    ->crumbs(fn ($crumbs) => $crumbs->push('Demo', route('demo')));

Route::get('demo/articles', ArticlesTable::class)
    ->middleware(['web'])
    ->name('demo.articles')
    ->crumbs(fn ($crumbs) => $crumbs->parent('demo')->push('Articles', route('demo.articles')));

Route::get('demo/articles/view/{article:id}', ArticlesView::class)
    ->middleware(['web'])
    ->name('demo.articles.view')
    ->crumbs(fn ($crumbs, $article) => $crumbs->parent('demo.articles')->push('View Article', route('demo.articles.view', $article)));

Route::get('demo/articles/edit/{article:id?}', ArticlesEdit::class)
    ->middleware(['web'])
    ->name('demo.articles.edit')
    ->crumbs(function ($crumbs, $article = null) {
        $article
            ? $crumbs->parent('demo.articles.view', $article)->push('Edit Article', route('demo.articles.edit', $article))
            : $crumbs->parent('demo.articles')->push('Add Article', route('demo.articles.edit'));
    });
