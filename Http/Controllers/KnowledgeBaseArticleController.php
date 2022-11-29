<?php

namespace App\Modules\Knowledgebase\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Knowledgebase\Models\Article;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class KnowledgeBaseArticleController extends Controller
{
    protected $viewPrefix = '';
    protected $routePrefix = 'kbp.';

    public function __construct()
    {
        $this->middleware(['auth']);
        view()->share('routePrefix', $this->routePrefix);
    }


    public function index()
    {
        $articles = Article::with('category')
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view("KnowledgeBase::{$this->viewPrefix}articles", compact('articles'));
    }

    public function show($slug, $article)
    {
        $article = Article::with(['tags', 'category'])
            ->withCount('tags')
            ->whereId($article)
            ->first();


        $article->timestamps = false;
        $article->views_count++;
        $article->save();
        return view("knowledgebase::{$this->viewPrefix}article", compact('article'));
    }

    public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->input('title',''));

        return response()->json(['slug' => $slug]);
    }

    public function table()
    {
        return view("knowledgebase::admin.{$this->viewPrefix}articles");
    }

    public function edit($id = null)
    {
        return view("knowledgebase::admin.{$this->viewPrefix}article", compact('id'));
    }

}
