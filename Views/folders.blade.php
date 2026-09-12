{{-- Module tree with the files of the current page highlighted --}}
@php
    $on = fn (string $page) => ($current ?? '') === $page ? 'text-success fw-bold' : '';
@endphp
<div class="documenter h-100">
    <h4>module structure</h4>
<pre class="mb-0"><code>demo-module/
├─ Livewire/
│  ├─ <span class="{{ $on('home') }}">Home.php</span>
│  ├─ <span class="{{ $on('table') }}">ArticlesTable.php</span>
│  ├─ <span class="{{ $on('view') }}">ArticlesView.php</span>
│  └─ <span class="{{ $on('edit') }}">ArticlesEdit.php</span>
├─ Views/
│  ├─ <span class="{{ $on('home') }}">home.blade.php</span>
│  ├─ <span class="{{ $on('table') }}">articles_table.blade.php</span>
│  ├─ <span class="{{ $on('view') }}">articles_view.blade.php</span>
│  ├─ <span class="{{ $on('edit') }}">articles_edit.blade.php</span>
│  ├─ menu.blade.php
│  └─ frontend_menu.blade.php
├─ Models/               Article.php, Author.php
├─ Database/             Migrations/, Seeders/
├─ config.php            layout, menu entry
├─ routes.php
└─ DemoModuleServiceProvider.php
</code></pre>
</div>
