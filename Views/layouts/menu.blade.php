
<nav class="navbar navbar-expand-lg navbar-light pb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Rapyd demo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav nav-tabs">
                <x-rpd::nav-link label="Home" route="demo" />
                <x-rpd::nav-link label="DataTable" route="demo.articles" />
                <x-rpd::nav-link label="DataView" route="demo.articles.view" :params="1"/>
                <x-rpd::nav-link label="DataEdit" route="demo.articles.edit" />
            </ul>
        </div>
    </div>
</nav>
