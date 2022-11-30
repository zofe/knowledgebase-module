@extends('knowledgebase::layouts.app')

@section('main-content')

<x-rpd::edit title="Articles Edit" xmlns:x-rpd="http://www.w3.org/1999/html">

        <x-slot name="buttons">
            <a href="{{ route('kb.articles.table') }}" class="btn btn-primary">cancel</a>
        </x-slot>

        <div class="row">
            <div class="form-group col-md-6">
                <x-rpd::input model="article.title" label="Title" />
            </div>
            <div class="form-group col-md-6">
                <x-rpd::input model="article.slug" label="Slug" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <x-rpd::select model="article.category_id" label="Category" :options="$categories" />
            </div>
            <div class="form-group col-md-6">

                <x-rpd::select-list model="roles" multiple :options="$available_roles" endpoint="/ajax/roles" label="Roles" />

{{--                <x-rpd::date-time model="date" format="dd/MM/yyyy HH:mm:ss" value-format="yyyy-MM-dd HH:mm:ss" label="Data" />--}}
{{--                <x-rpd::date model="date" format="dd/MM/yyyy" value-format="yyyy-MM-dd" label="Data" />--}}

            </div>
        </div>

        <div class="row mb-4">
            <div class="form-group col-md-12">
                <x-rpd::rich-text model="article.full_text" lazy label="Testo" />
            </div>

        </div>

        <x-slot name="actions">
            <button type="submit" class="btn btn-primary">Save</button>
        </x-slot>

    </x-rpd::edit>

@endsection
