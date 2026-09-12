<x-rpd::card>
    <x-rpd::table title="Articles" :items="$items">
        <x-slot name="filters">
            <x-rpd::input col="col" debounce="350" model="search" placeholder="search..." />
            <x-rpd::select col="col-3" model="author_id" :options="$authors" placeholder="author..." addempty />
        </x-slot>

        <x-slot name="buttons">
            <x-rpd::button route="demo.articles" color="outline-dark" label="Reset" />
            <x-rpd::button route="demo.articles.edit" color="outline-primary" label="Add" />
        </x-slot>

        <table class="table">
            <thead>
            <tr>
                <th><x-rpd::sort model="id" label="id" /></th>
                <th><x-rpd::sort model="title" label="title" /></th>
                <th>author</th>
                <th>body</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $article)
                <tr>
                    <td><x-rpd::nav-link :label="$article->id" route="demo.articles.view" :params="$article->id" /></td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->author?->firstname }}</td>
                    <td>{{ Str::limit(strip_tags($article->body), 50) }}</td>
                    <td class="text-end"><x-rpd::icon name="edit" route="demo.articles.edit" :params="$article->id" /></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-rpd::table>
</x-rpd::card>

@section('doc')
    <div class="row my-3">
        <div class="col-md-4">
            @include('demo::folders', ['current' => 'table'])
        </div>
        <div class="col-md-8">
            <div class="documenter h-100">
                <h4>route</h4>
                {!! App\Modules\Demo\Documenter::showCode('routes.php', false, "^Route::get\('demo\/articles',.*\)\);$") !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="documenter">
                <h4>component</h4>
                {!! App\Modules\Demo\Documenter::showCode('Livewire/ArticlesTable.php') !!}
            </div>
        </div>
        <div class="col-md-7">
            <div class="documenter">
                <h4>view</h4>
                {!! App\Modules\Demo\Documenter::showCode('Views/articles_table.blade.php', true) !!}
            </div>
        </div>
    </div>
@endsection
