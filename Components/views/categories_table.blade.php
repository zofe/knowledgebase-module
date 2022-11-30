@extends('knowledgebase::layouts.app')

@section('main-content')
<div>
        <x-rpd::table
            title="Categories"
            :items="$items"
        >

            <x-slot name="filters">
                    <div class="col">
                        <x-rpd::input debounce="350" model="search"  placeholder="search..." />
                    </div>
            </x-slot>


            <x-slot name="buttons">
                <a href="{{ route('kb.categories.table') }}" class="btn btn-dark">reset</a>
            </x-slot>

            <table class="table">
                <thead>
                <tr>
                    <th>
                        <x-rpd::sort model="id" label="id" />
                    </th>
                    <th>
                        <x-rpd::sort model="name" label="name" />
                    </th>
                    <th>slug</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($items as $category)
                    <tr>
                        <td>
                            <a href="{{ route('kb.categories.edit',$category->id) }}">{{ $category->id }}</a>
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </x-rpd::table>

</div>

@endsection