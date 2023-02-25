<?php

use App\Modules\Knowledgebase\Components\Admin\ArticlesEdit;
use App\Modules\Knowledgebase\Components\Admin\ArticlesTable;
use App\Modules\Knowledgebase\Components\Admin\CategoriesEdit;
use App\Modules\Knowledgebase\Components\Admin\CategoriesTable;
use App\Modules\Knowledgebase\Components\Admin\TagsEdit;
use App\Modules\Knowledgebase\Components\Admin\TagsTable;
use App\Modules\Knowledgebase\Components\Frontend\Article;
use App\Modules\Knowledgebase\Components\Frontend\Category;
use App\Modules\Knowledgebase\Components\Frontend\Home;
use App\Modules\Knowledgebase\Components\Frontend\Tag;
use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(function () {


    Route::get('kb', Home::class)
        ->name('kbp.kb')
        ->crumbs(function ($crumbs) {
            $crumbs->push('KnowledgeBase', route('kbp.kb'));
        });
    Route::get('kb/categories/{category:slug}', Category::class)
        ->name('kbp.categories.show')
        ->crumbs(function ($crumbs, $category) {
            $crumbs->parent('kbp.kb')->push(__($category->name), route('kbp.categories.show',$category));
        });
    Route::get('kb/articles/{article:slug}', Article::class)
        ->name('kbp.articles.show')
        ->crumbs(function ($crumbs, $article) {
            $crumbs->parent('kbp.kb')
                ->push(__($article->category->name), route('kbp.categories.show',$article->category))
                ->push(__($article->title), route('kbp.articles.show',$article))
            ;
        });
    Route::get('kb/tags/{tag:slug}', Tag::class)
        ->name('kbp.tags.show')
        ->crumbs(function ($crumbs, $tag) {
            $crumbs->parent('kbp.kb')->push(__($tag->name), route('kbp.tags.show',$tag));
        });


    Route::get('/kb/admin', \App\Modules\Knowledgebase\Components\Admin\Home::class)
        ->name('kb.admin')
        ->crumbs(function ($crumbs) {
            $crumbs->push('KnowledgeBase', route('kb.admin'));
        });
    Route::get('/kb/admin/tags/list', TagsTable::class)
        ->name('kb.admin.tags.table')
        ->crumbs(fn ($crumbs) => $crumbs->parent('kb.admin')->push(__('Tags'), route('kb.admin.tags.table')))
    ;
    Route::get('/kb/admin/tags/edit/{tag:id?}', TagsEdit::class)
        ->name('kb.admin.tags.edit')
        ->crumbs(function ($crumbs, $tag = null) {
            $title = $tag ? 'Edit Tag' : 'Create Tag';
            $crumbs->parent('kb.admin.tags.table')->push(__($title), route('kb.admin.tags.edit'));
        });
    Route::get('/kb/admin/categories/list', CategoriesTable::class)
        ->name('kb.admin.categories.table')
        ->crumbs(fn ($crumbs) => $crumbs->parent('kb.admin')->push(__('Categories'), route('kb.admin.categories.table')))
    ;
    Route::get('/kb/admin/categories/edit/{category:id?}', CategoriesEdit::class)
        ->name('kb.admin.categories.edit')
        ->crumbs(function ($crumbs, $category = null) {
            $title = $category ? 'Edit Category' : 'Create Category';
            $crumbs->parent('kb.admin.categories.table')->push(__($title), route('kb.admin.categories.edit'));
        });
    Route::get('/kb/admin/articles/list', ArticlesTable::class)
        ->name('kb.admin.articles.table')
        ->crumbs(fn ($crumbs) => $crumbs->parent('kb.admin')->push(__('Articles'), route('kb.admin.articles.table')))
    ;
    Route::get('/kb/admin/articles/edit/{article:id?}', ArticlesEdit::class)
        ->name('kb.admin.articles.edit')
        ->crumbs(function ($crumbs, $article = null) {
            $title = $article ? 'Edit Article' : 'Create Article';
            $crumbs->parent('kb.admin.articles.table')->push(__($title), route('kb.admin.articles.edit'));
        });
});
