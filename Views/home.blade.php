<x-rpd::card title="Rapyd CRUD demo">
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <p>
        Three pages, three files each: a Livewire component, a Blade view and a route.
        Every page shows its own source code underneath, so you can see exactly how little it takes.
    </p>

    @if($db_filled)
        <p class="mb-3">
            <x-rpd::button route="demo.articles" color="primary" label="Open the articles table" />
        </p>
        @if(config('demo.repopulate', true))
            <p class="small text-muted mb-0">
                Want a clean slate? <a href="#" wire:click.prevent="populate">Re-populate the demo data</a>
                (replaces all authors and articles; on a shared demo disable it with <code>DEMO_REPOPULATE=false</code>).
            </p>
        @endif
    @else
        <p class="mb-0">
            No demo data yet.
            <a href="#" wire:click.prevent="populate" class="btn btn-outline-primary btn-sm">Populate the database</a>
        </p>
    @endif
</x-rpd::card>

@section('doc')
    @include('demo::documenter_style')
    <div class="row my-3">
        <div class="col-md-4">
            @include('demo::folders', ['current' => 'home'])
        </div>
        <div class="col-md-8">
            <div class="documenter h-100">
                <h4>route</h4>
                {!! App\Modules\Demo\Documenter::showCode('routes.php', false, "^Route::get\('demo',.*\)\);$") !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="documenter">
                <h4>component</h4>
                {!! App\Modules\Demo\Documenter::showCode('Livewire/Home.php') !!}
            </div>
        </div>
        <div class="col-md-7">
            <div class="documenter">
                <h4>view</h4>
                {!! App\Modules\Demo\Documenter::showCode('Views/home.blade.php', true) !!}
            </div>
        </div>
    </div>
@endsection
