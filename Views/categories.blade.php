@extends('layouts.admin')

@section('main-content')

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route($routePrefix.'kb') }}">{{ __('Knowledge Base') }}</a>
            </li>
            <li class="breadcrumb-item active text-ucfirst">{{ __('categories') }}</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4 text-gray-800">{{ __('Categories') }}</h1>

    <div class="fb-heading">
        Knowledge Base
    </div>
    <hr class="style-three">

    <div class="row">



        <div class="row">

            @foreach($categories as $category)
                <div class="col-md-6 margin-bottom-20">
                    <div class="fat-heading-abb">
                        <a href="{{ route($routePrefix.'categories.show', [$category->slug, $category->id]) }}">
                            <i class="far fa-folder"></i> {{ $category->name }}
{{--                            <span class="cat-count">({{ $category->articles_count }})</span>--}}
                        </a>
                    </div>
                    <div class="fat-content-small padding-left-30">
                        <ul class="list-unstyled-indent">
                            @foreach($category->articles as $article)
                                <li>
                                    <a href="{{ route($routePrefix.'articles.show', [$article->slug, $article->id]) }}">
                                        <i class="far fa-file-alt"></i> {{ $article->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="row">
        {{ $categories->links() }}
    </div>


@endsection
