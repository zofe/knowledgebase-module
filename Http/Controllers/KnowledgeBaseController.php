<?php

namespace App\Modules\Knowledgebase\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use App\Modules\Knowledgebase\Models\Tag;

class KnowledgeBaseController extends Controller
{
    protected $viewPrefix = '';
    protected $routePrefix = 'kbp.';

    public function __construct()
    {
        //$this->middleware('auth');
        view()->share('routePrefix', $this->routePrefix);
    }

    public function index()
    {
        $categories = Category::withCount('articles')
            ->paginate(20);

        $popularArticles = Article::orderBy('views_count', 'desc')->take(6)->get();
        $latestArticles = Article::orderBy('id', 'desc')->take(6)->get();
        $footerCategories = Category::take(6)->get();

        $popularTags =  Tag::take(20)->get();

        return view("knowledgebase::{$this->viewPrefix}index", compact('categories','popularArticles', 'latestArticles', 'popularTags', 'footerCategories'));
    }




}
