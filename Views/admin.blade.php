@extends('layout::admin')

@push('left_sidebar')

    <x-rpd::nav-dropdown icon="fas fa-fw fa-book" label="Crud Demo" active="/demo">
                <x-rpd::nav-link label="Home" route="demo" type="collapse-item" />
                <x-rpd::nav-link label="DataTable" route="demo.articles" type="collapse-item" />
                <x-rpd::nav-link label="DataView" route="demo.articles.view" :params="1" type="collapse-item"/>
                <x-rpd::nav-link label="DataEdit" route="demo.articles.edit" type="collapse-item" />
    </x-rpd::nav-dropdown>


@endpush


