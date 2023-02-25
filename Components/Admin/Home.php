<?php

namespace App\Modules\Knowledgebase\Components\Admin;


use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use App\Modules\Knowledgebase\Models\Tag;
use Livewire\Component;



class Home extends Component
{
    public function render()
    {
        $categories= Category::withCount(['articles'])
            ->paginate(20);

        $popularArticles = Article::orderBy('views_count', 'desc')->take(6)->get();
        $latestArticles = Article::orderBy('id', 'desc')->take(6)->get();
        $footerCategories = Category::take(6)->get();

        $popularTags =  Tag::take(20)->get();

        return view("knowledgebase::Admin.views.index", compact('categories','popularArticles', 'latestArticles', 'popularTags', 'footerCategories'))
            ->layout('knowledgebase::admin');
    }
}
