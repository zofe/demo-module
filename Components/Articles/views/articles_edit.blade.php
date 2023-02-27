
<x-rpd::card>
    <div>
        <x-slot name="buttons">
        </x-slot>

        <x-rpd::edit title="Article Edit">
            <div>
                <div class="row">
                    <x-rpd::input col="col-4" model="article.title" label="Title" />
                    <x-rpd::select col="col-4" model="article.author_id" :options="$authors" label="Author" addempty />
                    <x-rpd::checkbox col="col-4 pt-2" model="article.public" label="Public" checkLabel="true" />
                </div>
                <div class="row mb-5">
                    <x-rpd::rich-text col="col-12 mb-5" model="article.body" label="Body" />
                </div>
            </div>
            <x-slot name="actions">
                <button type="submit" class="btn btn-primary">Save</button>
            </x-slot>
        </x-rpd::edit>

    </div>
</x-rpd::card>



@section('doc')
    <div class="row my-3">
        <div class="col-4">
            @include('demo::Articles.views.folders')
        </div>
        <div class="col-8">
            <div v-pre class="documenter h-100">
                <h4>route</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/routes.php", false, '^Route::get\(\'demo\/article\/edit.*}\);$') !!}
            </div>
        </div>
    </div>
    <div class="row" v-pre>
        <div class="col-6">
            <div class="documenter">
                <h4>component</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/Articles/ArticlesEdit.php") !!}
            </div>
        </div>
        <div class="col-6">
            <div class="documenter">
                <h4>view</h4>
{!! App\Modules\Demo\Documenter::showCode("Components/Articles/views/articles_edit.blade.php", true) !!}
            </div>
        </div>
    </div>
@endsection
