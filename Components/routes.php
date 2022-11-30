<?php


use App\Modules\Knowledgebase\Components\ArticlesEdit;
use App\Modules\Knowledgebase\Components\ArticlesTable;
use App\Modules\Knowledgebase\Components\CategoriesEdit;
use App\Modules\Knowledgebase\Components\CategoriesTable;
use App\Modules\Knowledgebase\Components\TagsEdit;
use App\Modules\Knowledgebase\Components\TagsTable;
use Illuminate\Support\Facades\Route;



Route::middleware(['web'])->group(function () {

    Route::get('/tags/list', TagsTable::class)
        ->name('kb.tags.table')
        ->crumbs(fn ($crumbs) => $crumbs->parent('kbp.kb')->push(__('Tags'), route('kb.tags.table')))
    ;
    Route::get('/tags/edit/{tag:id?}', TagsEdit::class)
        ->name('kb.tags.edit')
        ->crumbs(function ($crumbs, $tag = null) {
            $title = $tag ? 'Edit Tag' : 'Create Tag';
            $crumbs->parent('kb.tags.table')->push(__($title), route('kb.tags.edit'));
        });

    Route::get('/categories/list', CategoriesTable::class)
        ->name('kb.categories.table')
        ->crumbs(fn ($crumbs) => $crumbs->parent('kbp.kb')->push(__('Categories'), route('kb.categories.table')))
    ;
    Route::get('/categories/edit/{category:id?}', CategoriesEdit::class)
        ->name('kb.categories.edit')
        ->crumbs(function ($crumbs, $category = null) {
            $title = $category ? 'Edit Category' : 'Create Category';
            $crumbs->parent('kb.categories.table')->push(__($title), route('kb.categories.edit'));
        });

    Route::get('/articles/list', ArticlesTable::class)
        ->name('kb.articles.table')
        ->crumbs(fn ($crumbs) => $crumbs->parent('kbp.kb')->push(__('Articles'), route('kb.articles.table')))
    ;
    Route::get('/articles/edit/{article:id?}', ArticlesEdit::class)
        ->name('kb.articles.edit')
        ->crumbs(function ($crumbs, $article = null) {
            $title = $article ? 'Edit Article' : 'Create Article';
            $crumbs->parent('kb.articles.table')->push(__($title), route('kb.articles.edit'));
        });
});
