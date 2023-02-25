<?php

namespace App\Modules\Knowledgebase\Components\Admin;


use App\Modules\Knowledgebase\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;


class CategoriesEdit extends Component
{
    public $category;

    public  $roles = [];
    public $available_roles = [];

    protected $rules = [
        'category.name' => 'required',
        'category.slug' => 'required|alpha_dash|unique:categories,slug',
    ];
    protected $listeners = [
        'refresh'       => '$refresh',
    ];

    //todo da mettere in un trait
    public function addRule($field, $rule)
    {
        $this->rules[$field] = $rule;
    }

    public function updatedCategoryName($value)
    {
        $this->category->slug = SlugService::createSlug(Category::class, 'slug', $value);
    }
    public function updatedCategorySlug($value)
    {
        $this->category->slug = SlugService::createSlug(Category::class, 'slug', $value);
    }


    public function updated($field)
    {
        $this->resetErrorBag($field);
    }

    public function mount(?Category $category)
    {
        $this->category = $category;


//        $this->roles = ($category) ? $this->category->roles->pluck('id') :
//            CompanyRole::query()->get()->pluck('id')->toArray();
//
//        $this->available_roles = CompanyRole::query()->get()->pluck('name','id');
    }

    public function save()
    {
        $this->validate();
        $this->category->save();

        return redirect()->to(route('kb.admin.categories.table'));
    }

    public function delete()
    {
        if($this->category->articles()->count() < 1) {
            $this->category->delete();

            session()->flash('message', __('message.deleted'));
            return redirect(route_lang($this->listRoute));
        }
    }

    public function render()
    {
        return view('knowledgebase::Admin.views.categories_edit')
            ->layout('knowledgebase::admin');
    }
}
