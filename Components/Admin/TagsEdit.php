<?php

namespace App\Modules\Knowledgebase\Components\Admin;


use App\Modules\Knowledgebase\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;


class TagsEdit extends Component
{
    public $tag;

    protected $rules = [
        'tag.name'  => 'required',
        'tag.slug'  => 'required|alpha_dash|unique:tags,slug',
    ];

    //todo da mettere in un trait
    public function addRule($field, $rule)
    {
        $this->rules[$field] = $rule;
    }

    public function updatedTagName($value)
    {
        $this->tag->slug = SlugService::createSlug(Tag::class, 'slug', $value);
    }
    public function updatedTagSlug($value)
    {
        $this->tag->slug = SlugService::createSlug(Tag::class, 'slug', $value);
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
    }

    public function mount(?Tag $tag)
    {

        $this->tag = $tag;
    }

    public function save()
    {
        //todo solo in update
        //$this->addRule('tag.slug', 'required|alpha_dash|unique:tags,slug,'.$this->rid);
        $this->validate();
        $this->tag->save();

        return redirect()->to(route('kb.admin.tags.table'));
    }

    public function render()
    {
        return view('knowledgebase::Admin.views.tags_edit')
            ->layout('knowledgebase::admin');
    }
}
