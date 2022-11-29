<?php

namespace App\Modules\Knowledgebase\Components;

use App\Modules\Knowledgebase\Models\Category;
use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;

class CategoriesTable extends Component
{
    use WithDataTable;
    public $search;

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
        $items = Category::ssearch($this->search)
        ;
        return $items = $items
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage)
            ;
    }

    public function render()
    {
        $items = $this->getDataSet();

        return view('knowledgebase::views.categories_table', compact('items'));
    }
}
