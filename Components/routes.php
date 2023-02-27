<?php

use App\Modules\Demo\Components\Articles\ArticlesTable;
use App\Modules\Demo\Components\Articles\ArticlesView;
use App\Modules\Demo\Components\Articles\ArticlesEdit;

use App\Modules\Demo\Components\Home;
use Illuminate\Support\Facades\Route;


Route::get('demo/', Home::class)
    ->middleware(['web'])
    ->name('demo')
    ->crumbs(function ($crumbs) {
        $crumbs->push('Home', route('demo'));
    });


Route::get('demo/articles', ArticlesTable::class)
    ->middleware(['web'])
    ->name('demo.articles')
    ->crumbs(fn ($crumbs) => $crumbs->parent('demo')->push('Articles', route('demo.articles')));

Route::get('demo/article/view/{article:id}', ArticlesView::class)
    ->middleware(['web'])
    ->name('demo.articles.view')
    ->crumbs(function ($crumbs, $article) {
        $crumbs->parent('demo.articles')->push('View Article', route('demo.articles.view', $article));
    });


Route::get('demo/article/edit/{article:id?}', ArticlesEdit::class)
    ->middleware(['web'])
    ->name('demo.articles.edit')
    ->crumbs(function ($crumbs, $article = null) {
        if ($article) {
            $crumbs->parent('demo.articles.view', $article)
                ->push('Edit Article', route('demo.articles.edit', $article));
        } else {
            $crumbs->parent('demo.articles')
                ->push('Create Article', route('demo.articles.edit'));
        }
    });

