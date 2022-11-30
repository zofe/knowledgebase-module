<?php

use App\Modules\Knowledgebase\Http\Controllers\KnowledgeBaseArticleController;
use App\Modules\Knowledgebase\Http\Controllers\KnowledgeBaseCategoryController;
use App\Modules\Knowledgebase\Http\Controllers\KnowledgeBaseController;
use App\Modules\Knowledgebase\Http\Controllers\KnowledgeBaseTagController;
use Illuminate\Support\Facades\Route;


Route::get('kb', [KnowledgeBaseController::class,'index'])
    ->middleware(['web'])
    ->name('kbp.kb')
    ->crumbs(function ($crumbs) {
            $crumbs->push('KnowledgeBase', route('kbp.kb'));
    });

Route::get('kb/categories/check_slug', [KnowledgeBaseCategoryController::class,'check_slug'])->name('kbp.categories.check_slug');
Route::get('kb/categories/{slug}/{category}', [KnowledgeBaseCategoryController::class,'show'])->name('kbp.categories.show');
Route::get('kb/articles/check_slug', [KnowledgeBaseArticleController::class,'check_slug'])->name('kbp.articles.check_slug');
Route::get('kb/articles/{slug}/{article}', [KnowledgeBaseArticleController::class,'show'])->name('kbp.articles.show');
Route::get('kb/articles', [KnowledgeBaseArticleController::class,'index'])->name('kbp.articles.index');
Route::get('kb/tags/{slug}/{tag}', [KnowledgeBaseTagController::class,'show'])->name('kbp.tags.show');
