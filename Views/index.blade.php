@extends('knowledgebase::layouts.app')

@section('main-content')

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route($routePrefix.'kb') }}">{{ __('Knowledge Base') }}</a>
            </li>
            <li class="breadcrumb-item active">Index</li>
        </ol>
    </nav>


    <h1 class="h3 mb-4 text-gray-800">{{ __('Knowledge Base') }}</h1>


    <div class="row">

        <div class="col-md-8">

            <div class="fb-heading">
                Categorie
            </div>
            <hr class="style-three">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-6 margin-bottom-20">
                                <div class="fat-heading-abb">
                                    <a href="{{ route($routePrefix.'categories.show', [$category->slug, $category->id]) }}">
                                        <i class="far fa-folder"></i> {{ $category->name }}
                                        @if($category->articles->count()>6)
                                        &nbsp;
                                        <span class="cat-count small text-gray-600">leggi tutti &raquo;</span>
                                        @endif
                                    </a>
                                </div>
                                <div class="fat-content-small padding-left-30">
                                    <ul class="list-unstyled-indent">
                                        @foreach($category->articles as $article)
                                            @if($loop->index >= 5)
                                                @break
                                            @endif
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

                {{ $categories->links() }}
            </div>
        </div>


        <div class="col-md-4">
            <div class="row margin-top-20">
                <div class="col-md-12">
                    <div class="fb-heading-small">
                        I Più Letti
                    </div>
                    <hr class="style-three">
                    <div class="fat-content-small padding-left-10">
                        <ul class="list-unstyled-indent">
                            @foreach ($popularArticles as $article)
                                <li>
                                    <a href="{{ route($routePrefix.'articles.show', [$article->slug, $article->id]) }}">
                                        <i class="far fa-file-alt"></i> {{ $article->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row margin-top-20">
                <div class="col-md-12">
                    <div class="fb-heading-small">
                        Tag
                    </div>
                    <hr class="style-three">
                    <div class="fat-content-tags padding-left-10">
                        @foreach ($popularTags as $tag)
                            <a href="{{ route($routePrefix.'tags.show', [$tag->slug, $tag->id]) }}"  class="badge bg-secondary">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
