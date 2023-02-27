
<div>
    <h3>Welcome to Rapyd Demo</h3>

    @if(Session::has('message'))
        <div class="alert alert-success">
            {!! Session::get('message') !!}
        </div>
    @endif

    <p class="small">
        Rapyd is a preset of laravel components.<br>
        The aim of this demo is to show how make custom CRUD domponents in few lines of code.<br>
    </p>

    <hr>

    <p>

        @if(!Session::has('message'))
            @if (!$db_filled)
                It seems that no demo data is present, please:<br />
                <br />
                <a href="#" wire:click="populate" class="btn btn-outline-danger">Populate Database</a>
            @else
                Check out the potential of rapyd-livewire here: <br />

                <a href="{{ route('demo.articles') }}" class="btn btn-primary">Crud Demo</a>


                <br /><br />
                You can reset database demo data:<br />

                <a href="#" wire:click="populate" class="btn btn-outline-danger">Re-Populate</a>
            @endif
        @endif
        <br />
        <br />

    </p>
</div>


