
<div>
    <h1 class="h3 mb-4 text-gray-800">{{ $article->title }}</h1>

    <div class="row">

        <div class="col-12">

            <!-- ARTICLE  -->
            <div class="card">
                <div class="card-body">

                    <div class="article-info">

                        @if(optional($article->category)->count())
                            <div class="art-category">
                                <a href="{{ route('kbp.categories.show', $article->category->slug) }}">
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
                        </div>
                    @endif
                    @if($article->tags_count)
                        <div class="article-content py-3">
                            <div class="article-tags">
                                <b>Tags:</b>
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('kbp.tags.show', [$tag->slug, $tag->id]) }}" class="badge bg-secondary">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>


        </div>

    </div>

</div>
