<?php

namespace App\Modules\Knowledgebase\Components\Frontend;


use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;



class Tag extends Component
{
    use WithDataTable;

    public $tag;

    public function mount(?\App\Modules\Knowledgebase\Models\Tag $tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        $articles = $this->tag->articles()->with('category')
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view("knowledgebase::Frontend.views.tag", compact('articles'));

    }
}
