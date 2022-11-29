<?php

namespace App\Modules\Knowledgebase\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Knowledgebase\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class KnowledgeBaseCategoryController extends Controller
{
    protected $viewPrefix = '';
    protected $routePrefix = 'kbp.';

    public function __construct()
    {
        $this->middleware(['auth']);
        view()->share('routePrefix', $this->routePrefix);
    }

    public function show($slug, Category $category)
    {
        $articles = $category->articles()->paginate(20);

        $isInternal = $category->is_internal;
        return view("knowledgebase::{$this->viewPrefix}category", compact(['category', 'articles', 'isInternal']));
    }

    public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->input('name',''));

        return response()->json(['slug' => $slug]);
    }

    public function table()
    {
        return view("knowledgebase::admin.{$this->viewPrefix}categories");
    }

    public function edit($id = null)
    {
        return view("knowledgebase::admin.{$this->viewPrefix}category", compact('id'));
    }

}
