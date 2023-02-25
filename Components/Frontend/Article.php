<?php

namespace App\Modules\Knowledgebase\Components\Frontend;


use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;



class Article extends Component
{
    use WithDataTable;

    public $article;

    public function mount(?\App\Modules\Knowledgebase\Models\Article $article)
    {
        $this->article = $article;
        $this->article->views_count++;
        $this->article->save();
    }

    public function render()
    {
        return view("knowledgebase::Frontend.views.article");

    }
}
