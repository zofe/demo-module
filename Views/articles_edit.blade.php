<x-rpd::card>
    <x-rpd::edit title="Article">
        <div class="row">
            <x-rpd::input col="col-md-6" model="article.title" label="Title" />
            <x-rpd::select col="col-md-6" model="article.author_id" :options="$authors" label="Author" addempty />
        </div>
        <div class="row">
            <x-rpd::date col="col-md-4" model="article.publication_date" format="dd/MM/yyyy" value-format="yyyy-MM-dd" label="Publication date" />
            <x-rpd::checkbox col="col-md-4 pt-4" model="article.public" label="Public" checkLabel="visible to everyone" />
        </div>
        <div class="row mb-4">
            <x-rpd::rich-text col="col-12" model="article.body" label="Body" />
        </div>
        <x-slot name="actions">
            <x-rpd::button type="submit" label="Save" />
        </x-slot>
    </x-rpd::edit>
</x-rpd::card>

@section('doc')
    <div class="row my-3">
        <div class="col-md-4">
            @include('demo::folders', ['current' => 'edit'])
        </div>
        <div class="col-md-8">
            <div class="documenter h-100">
                <h4>route</h4>
                {!! App\Modules\Demo\Documenter::showCode('routes.php', false, "^Route::get\('demo\/articles\/edit.*\}\);$") !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="documenter">
                <h4>component</h4>
                {!! App\Modules\Demo\Documenter::showCode('Livewire/ArticlesEdit.php') !!}
            </div>
        </div>
        <div class="col-md-7">
            <div class="documenter">
                <h4>view</h4>
                {!! App\Modules\Demo\Documenter::showCode('Views/articles_edit.blade.php', true) !!}
            </div>
        </div>
    </div>
@endsection
