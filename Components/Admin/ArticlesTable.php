<?php

namespace App\Modules\Knowledgebase\Components\Admin;

use App\Modules\Knowledgebase\Models\Article;
use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;

class ArticlesTable extends Component
{
    use WithDataTable;
    public $search;

    //todo da mettere in un trait
    public function addRule($field, $rule)
    {
        $this->rules[$field] = $rule;
    }

    public function mount()
    {
        $this->sortAsc = true;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getDataSet()
    {
        $items = Article::ssearch($this->search)
        ;

        return $items = $items
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage)
            ;
    }

    public function render()
    {
        $items = $this->getDataSet();

        return view('knowledgebase::Admin.views.articles_table', compact('items'))
            ->layout('knowledgebase::admin');
    }
}
