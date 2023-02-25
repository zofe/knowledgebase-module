<?php

namespace App\Modules\Knowledgebase\Components\Admin;

use App\Modules\Knowledgebase\Models\Article;
use App\Modules\Knowledgebase\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class ArticlesEdit extends Component
{
    use WithFileUploads;

    public $article;
    public $categories = [];
    public $tags = [];
    public $available_tags = [];


    protected $rules = [
        'article.title' => 'required',
        'article.slug'  => 'required|alpha_dash|unique:articles,slug',
        'article.short_text'    => 'nullable',
        'article.full_text'     => 'nullable',
        'article.category_id'   => 'required',
    ];
    protected $listeners = [
        'set:article.category_id'   => 'setCategory',
        'set:article.full_text'     => 'setFullText',
    ];

    public function setCategory($value)
    {
        $this->article->category_id = ($value) ? $value : null;
    }

    public function setFullText($value)
    {
        $this->article->full_text = $value;
    }


    public function uploadAttachment()
    {
        if($this->attachment) {
            $filename = $this->attachment->store('public/uploads/docs');
            $this->article->attachment = basename($filename);
        }
    }

    public function deleteAttachment()
    {
        if($this->article->attachment) {
            Storage::delete('public/uploads/docs/'.$this->article->attachment);
            $this->article->attachment = null;
            $this->article->save();
        }
    }


    public function updatedArticleTitle($value)
    {
        $this->article->slug = SlugService::createSlug(Article::class, 'slug', $value);
    }
    public function updatedArticleSlug($value)
    {
        $this->article->slug = SlugService::createSlug(Article::class, 'slug', $value);
    }


    public function updated($field)
    {
        $this->resetErrorBag($field);
    }

    public function mount(?Article $article)
    {
        $this->article = $article;
        $this->categories = Category::query()->get()->pluck('name','id')->toArray();
    }

    public function save()
    {
        if($this->article->exists) {
            $this->addRule('article.title', 'required|unique:articles,title,'.$this->article->id);
            $this->addRule('article.slug', 'required|unique:articles,slug,'.$this->article->id);
        }
        $this->validate();


        $this->article->save();

        return redirect()->to(route('kb.admin.articles.table'));
    }


    public function render()
    {
        return view('knowledgebase::Admin.views.articles_edit')
            ->layout('knowledgebase::admin');
    }
}
