<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\Portfolio as PortfolioModel;
use Livewire\Component;
use Livewire\WithPagination;

class Portfolio extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = 'portfolios.id';
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
            $element = PortfolioModel::find($selection);
            $element->delete();
        }
        return to_route('portfolios')->with('message', __('generic.bulkDelete'));
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

        $data = PortfolioModel::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $data->where('name', 'like', '%' . $this->search . '%')->count();
        }

        $total = $data->count();
        $data = $data->paginate($this->perPage);

        return view('livewire.portfolio.portfolio', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-slate-600',
            'bgMenuColor'           => 'bg-slate-800',
            'menuTextColor'         => 'text-slate-800',
            'focusColor'            => 'focus:ring-slate-500 focus:border-slate-500',
            // Data
            'portfolios' => $data,
            'found' => $found,
            'column' => $this->orderColumn,
            'total' => $total,
        ])->layout('layouts.app');
    }
   
}
