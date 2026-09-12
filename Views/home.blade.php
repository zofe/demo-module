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
                Want a clean slate? <a href="#" wire:click.prevent="populate">Re-populate the demo data</a>.
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
    @include('demo::folders', ['current' => 'home'])
@endsection
