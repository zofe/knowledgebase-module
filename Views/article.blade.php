@extends('knowledgebase:layouts.app')

@section('main-content')

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route($routePrefix.'kb') }}">{{ __('Knowledge Base') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route($routePrefix.'categories.show', [$article->category->slug, $article->category->id]) }}">{{ $article->category->name }}</a>
            </li>
            <li class="breadcrumb-item active">{{ $article->title }}</li>
        </ol>
    </nav>

    <h1 class="h3 mb-4 text-gray-800">{{ $article->title }}</h1>



    <div class="row">

        <div class="col-12">

            <!-- ARTICLE  -->
            <div class="card">
                <div class="card-body">

                    <div class="article-info">

                        @if(optional($article->category)->count())
                            <div class="art-category">
                                <a href="{{ route($routePrefix.'categories.show', [$article->category->slug, $article->category->id]) }}">
                                    <i class="far fa-folder"></i> {{ $article->category->name }}
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="article-content">
                        {!! $article->full_text !!}
                    </div>
                    @if($article->attachment)
                        <div class="article-content py-3">
                            <div class="article-tags">
                                <a target="_blank" href="{{ asset('storage/uploads/docs/'.$article->attachment) }}"><i class="fas fa-file"></i> Allegato</a>
                        </div>
                    @endif

                    @if($article->tags_count)
                        <div class="article-content py-3">
                            <div class="article-tags">
                                <b>Tags:</b>
                                @foreach($article->tags as $tag)
                                    <a href="{{ route($routePrefix.'tags.show', [$tag->slug, $tag->id]) }}" class="badge bg-secondary">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>


    </div>


@endsection
