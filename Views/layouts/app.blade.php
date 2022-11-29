<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rapyd Livewire Widgets')</title>
    <meta name="description" content="@yield('description', 'crud widgets for laravel. datatable, grids, forms, in a simple package')" />
    @section('meta', '')

    <link href="//fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('vendor/rapyd-livewire/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.2.3/gh-fork-ribbon.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    @rapydStyles
</head>
<body>
<a class="github-fork-ribbon" href="https://github.com/zofe/rapyd-livewire" data-ribbon="Fork me on GitHub" title="Fork me on GitHub">Fork me on GitHub</a>

<main class="d-flex" x-data x-cloak>

    <x-rpd::sidebar title="Rapyd.dev" class="p-3 text-white border-end">

        <x-rpd::nav-item label="Demo" route="demo" active="/demo" />

    </x-rpd::sidebar>




    <div id="app">

        <div class="container py-3">
            <header>

                <x-rpd::nav-tabs title="Rapyd demo" class="navbar-light pb-4">
                    <x-rpd::nav-link label="Home" route="demo" />
                    <x-rpd::nav-link label="DataTable" route="demo.articles" />
                    <x-rpd::nav-link label="DataView" route="demo.articles.view" :params="1"/>
                    <x-rpd::nav-link label="DataEdit" route="demo.articles.edit" />
                </x-rpd::nav-tabs>

                <x-rpd::breadcrumbs class="breadcrumb-item" active="active" />

            </header>

            @section('main-content')
                <div class="row">
                    <div class="col-sm-12 gx-5">
                        @yield('content')
                        {{ $slot ??'' }}

                    </div>
                </div>
            @show


            <div class="row">
                <div class="col-sm-12 gx-5">
                    @yield('doc')
                </div>
            </div>


        </div>
    </div>

    <div id="footer"></div>

</main>

@livewireScripts
@rapydScripts

<script src="{{ asset('vendor/rapyd-livewire/bootstrap.js') }}" defer></script>
<script src="{{ asset('vendor/rapyd-livewire/alpine.js') }}" defer></script>
</body>
</html>
