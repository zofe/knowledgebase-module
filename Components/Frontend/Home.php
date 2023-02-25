<?php

namespace App\Modules\Knowledgebase\Components\Frontend;


use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use App\Modules\Knowledgebase\Models\Tag;
use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;


class Home extends Component
{
    use WithDataTable;


    public function render()
    {
        $categories= Category::withCount(['articles'])
            ->paginate(20);

        $popularArticles = Article::orderBy('views_count', 'desc')->take(6)->get();
        $latestArticles = Article::orderBy('id', 'desc')->take(6)->get();
        $footerCategories = Category::take(6)->get();

        $popularTags =  Tag::take(20)->get();

        return view("knowledgebase::Frontend.views.index", compact('categories','popularArticles', 'latestArticles', 'popularTags', 'footerCategories'));
    }
}
