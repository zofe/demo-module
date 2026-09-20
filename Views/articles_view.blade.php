<x-rpd::card>
    <x-rpd::view title="Article">
        <x-slot name="buttons">
            <x-rpd::button route="demo.articles" color="outline-primary" label="List" />
            <x-rpd::button :route="['demo.articles.edit', $article->id]" color="outline-primary" label="Edit" />
        </x-slot>

        <dl class="row">
            <dt class="col-3">{{ __('Title') }}</dt>
            <dd class="col-9">{{ $article->title }}</dd>
            <dt class="col-3">{{ __('Author') }}</dt>
            <dd class="col-9">{{ $article->author?->firstname }} {{ $article->author?->lastname }}</dd>
            <dt class="col-3">{{ __('Public') }}</dt>
            <dd class="col-9">{{ $article->public ? __('yes') : __('no') }}</dd>
            <dt class="col-3">{{ __('Body') }}</dt>
            <dd class="col-9">{!! $article->body !!}</dd>
        </dl>
    </x-rpd::view>
</x-rpd::card>

@section('doc')
    @include('demo::documenter_style')
    <div class="row my-3">
        <div class="col-md-4">
            @include('demo::folders', ['current' => 'view'])
        </div>
        <div class="col-md-8">
            <div class="documenter h-100">
                <h4>{{ __('route') }}</h4>
                {!! App\Modules\Demo\Documenter::showCode('routes.php', false, "^Route::get\('demo\/articles\/view.*\)\);$") !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="documenter">
                <h4>{{ __('component') }}</h4>
                {!! App\Modules\Demo\Documenter::showCode('Livewire/ArticlesView.php') !!}
            </div>
        </div>
        <div class="col-md-7">
            <div class="documenter">
                <h4>{{ __('view') }}</h4>
                {!! App\Modules\Demo\Documenter::showCode('Views/articles_view.blade.php', true) !!}
            </div>
        </div>
    </div>
@endsection
