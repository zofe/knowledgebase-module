<?php

namespace App\Modules\Knowledgebase\Components;

use App\Modules\Knowledgebase\Models\Tag;
use Livewire\Component;
use Zofe\Rapyd\Traits\WithDataTable;

class TagsTable extends Component
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
        $items = Tag::ssearch($this->search)
        ;

        return $items = $items
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage)
            ;
    }

    public function render()
    {
        $items = $this->getDataSet();

        return view('knowledgebase::views.tags_table', compact('items'));
    }
}
