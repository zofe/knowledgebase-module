<?php

namespace App\Modules\Knowledgebase\Components\Frontend;


use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;



class Category extends Component
{
    use WithDataTable;

    public $category;

    public function mount(?\App\Modules\Knowledgebase\Models\Category $category)
    {
        $this->category = $category;

    }

    public function render()
    {
        $articles = $this->category->articles()->paginate(20);

        return view("knowledgebase::Frontend.views.category", compact( 'articles'));


    }
}
