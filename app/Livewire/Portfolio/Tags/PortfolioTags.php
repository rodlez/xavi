<?php

namespace App\Livewire\Portfolio\Tags;

use App\Models\Portfolio\PortfolioTag;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioTags extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = 'pf_tags.id';
    public $sortOrder = 'desc';
    public $sortLink = '<i class="fa-solid fa-caret-down"></i>';
    public $search = '';
    public $perPage = 25;

    public $selections = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function bulkClear()
    {
        $this->selections = [];
    }

    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $element = PortfolioTag::find($selection);
            $element->delete();
        }

        return to_route('pf_tags')->with('message', __('generic.bulkDelete'));
    }

    public function sorting($columnName = '')
    {
        $caretOrder = 'up';
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = 'up';
        }

        $this->sortLink = '<i class="fa-solid fa-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }

    public function render()
    {
        $found = 0;

        $data = PortfolioTag::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $data->where('name', 'like', '%' . $this->search . '%')->count();
        }

        $total = $data->count();
        $data = $data->paginate($this->perPage);

        return view('livewire.portfolio.tags.portfolio-tags', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-yellow-600',
            'textMenuHeader' => 'hover:text-yellow-400',
            'bgMenuColor' => 'bg-yellow-800',
            'menuTextColor' => 'text-yellow-800',
            'focusColor' => 'focus:ring-yellow-500 focus:border-yellow-500',
            // Data
            'tags' => $data,
            'found' => $found,
            'column' => $this->orderColumn,
            'total' => $total,
        ])->layout('layouts.app');
    }
    
}
