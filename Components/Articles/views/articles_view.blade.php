<x-rpd::card>
    <x-rpd::view title="Article Detail">
      <x-slot name="buttons">
        <a href="{{ route('demo.articles') }}" class="btn btn-outline-primary">list</a>
        <a href="{{ route('demo.articles.edit',$article->id) }}" class="btn btn-outline-primary">edit</a>
      </x-slot>

      <dl class="row">
        <dt class="col-3">Title</dt>
        <dd class="col-9">{{ $article->title }}</dd>
        <dt class="col-3">Author</dt>
        <dd class="col-9">
            {{ $article->author->firstname }}
            {{ $article->author->lastname }}
        </dd>
      </dl>

    </x-rpd::view>
</x-rpd::card>

@section('doc')
<div class="row my-3">
    <div class="col-4">
        @include('demo::Articles.views.folders')
    </div>
    <div class="col-8">
        <div v-pre class="documenter h-100">
            <h4>route</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/routes.php", false, '^Route::get\(\'demo\/article\/view\/.*}\);$') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-5">
        <div v-pre class="documenter">
            <h4>component</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/Articles/ArticlesView.php") !!}
        </div>
    </div>
    <div class="col-7">
        <div v-pre class="documenter">
            <h4>view</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/Articles/views/articles_view.blade.php", true) !!}
        </div>
    </div>
</div>

@endsection
