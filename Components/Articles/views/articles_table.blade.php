<x-rpd::card>
    <x-rpd::table
        title="List Articles"
        :items="$items"
    >
        <x-slot name="filters">
            <x-rpd::input col="col" debounce="350" model="search"  placeholder="search..." />
            <x-rpd::select col="col" lazy model="author_id" :options="$authors" placeholder="author..."
                           addempty />
        </x-slot>

        <x-slot name="buttons">
            <x-rpd::button route="demo.articles" color="outline-dark" label="reset" />
            <x-rpd::button route="demo.articles.edit" color="outline-primary" label="add" />
        </x-slot>

        <table class="table">
            <thead>
            <tr>
                <th>
                    <x-rpd::sort model="id" label="id" />
                </th>
                <th>title</th>
                <th>author</th>
                <th>body</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $article)
            <tr>
                <td>
                    <a href="{{ route('demo.articles.view',$article->id) }}">{{ $article->id }}</a>
                </td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->author->firstname }}</td>
                <td>{{ Str::limit($article->body,50) }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </x-rpd::table>
</x-rpd::card>


@section('doc')
<div class="row my-3">
    <div class="col-4">
        @include('demo::Articles.views.folders')
    </div>
    <div class="col-8">
        <div v-pre class="documenter h-100">
            <h4>route</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/routes.php", false, '^Route::get\(\'demo\/articles\'.*\)\)\);$') !!}
        </div>
    </div>
</div>
<div class="row" v-pre>
    <div class="col-5">
        <div class="documenter">
            <h4>component</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/Articles/ArticlesTable.php") !!}
        </div>
    </div>
    <div class="col-7">
        <div class="documenter">
            <h4>view</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/Articles/views/articles_table.blade.php", true) !!}
        </div>
    </div>
</div>
@endsection
