<?php

namespace App\Modules\Knowledgebase\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Knowledgebase\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class KnowledgeBaseTagController extends Controller
{
    protected $viewPrefix = '';
    protected $routePrefix = 'kbp.';

    public function __construct()
    {
        $this->middleware(['auth']);
        view()->share('routePrefix', $this->routePrefix);
    }

    public function show($slug, Tag $tag)
    {

        $articles = $tag->articles()->with('category')
            ->orderBy('id', 'desc')
            ->paginate(8);


        return view("knowledgebase::{$this->viewPrefix}tags", compact('articles', 'tag'));
    }

    public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Tag::class, 'slug', $request->input('name',''));

        return response()->json(['slug' => $slug]);
    }

    public function table()
    {
        return view("knowledgebase::admin.{$this->viewPrefix}tags");
    }

    public function edit($id = null)
    {
        return view("knowledgebase::admin.{$this->viewPrefix}tag", compact('id'));
    }
}
