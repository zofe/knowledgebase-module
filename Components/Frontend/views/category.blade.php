

<div>
    <h1 class="h3 mb-4 text-gray-800">{{ $category->name }}</h1>

    <div class="fb-heading">
        <i class="far fa-folder"></i> Category: {{ $category->name }}

    </div>
    <hr class="style-three">


    <div class="row">


        @foreach($articles as $article)
            <div class="col-md-6 col-lg-6 col-xl-3 mb-2 px-1">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="article-heading-abb">
                            <a href="{{ route('kbp.articles.show', [$article->slug, $article->id]) }}">
                                <i class="far fa-newspaper"></i> {{ $article->title }} </a>
                        </div>
                        <div class="article-info">
                            @if(optional($article->category)->count())
                                <div class="art-category">
                                    <a href="{{ route('kbp.categories.show', [$article->category->slug, $article->category->id]) }}">
                                        <i class="far fa-folder"></i> {{ $article->category->name }}
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="article-content">
                            <p class="block-with-text">
                                {{ $article->short_text }}
                            </p>
                        </div>
                        <div class="article-read-more">
                            <a href="{{ route('kbp.articles.show', [$article->slug, $article->id]) }}" class="btn btn-outline-primary">{{ __('Read more...') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="row">
        {{ $articles->links() }}
    </div>

</div>



