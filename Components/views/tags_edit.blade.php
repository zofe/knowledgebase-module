@extends('knowledgebase::layouts.app')

@section('main-content')
    <x-rpd::edit title="Tags Edit" wire:submit.prevent="prova">

        <x-slot name="buttons">
            <a href="{{ route('kb.tags.table') }}" class="btn btn-primary">cancel</a>
        </x-slot>

        <div class="row">
            <div class="form-group col-md-6">
                <x-rpd::input model="tag.name" label="Name" />
            </div>
            <div class="form-group col-md-6">
                <x-rpd::input model="tag.slug" label="Slug" />
            </div>
        </div>

        <div class="row mb-4">
        </div>

        <x-slot name="actions">
{{--            <a wire:click.prevent="save" class="btn btn-primary" role="button" href="#">Save</a>--}}
            <button type="submit" class="btn btn-primary">Save</button>
        </x-slot>

    </x-rpd::edit>

@endsection