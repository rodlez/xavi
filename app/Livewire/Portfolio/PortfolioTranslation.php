<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioTranslation as PortfolioTranslationModel;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioTranslation extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "portfolios_translation.id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="fa-solid fa-caret-down"></i>';
    public $search = "";
    public $perPage = 25;

    public $selections = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = "";
    }

    public function bulkClear()
    {
        $this->selections = [];
    }

    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $element = PortfolioTranslationModel::find($selection);
            $element->delete();
        }

        return to_route('portfolios_trans')->with('message', __('generic.bulkDelete'));
    }

    public function sorting($columnName = "")
    {
        $caretOrder = "up";
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

        $translations = PortfolioTranslationModel::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {

            $found = $translations->where('title', "like", "%" . $this->search . "%")->count();
        }

        //$total = $translations->count();
        $translations = $translations->paginate($this->perPage);
        $totalTranslations = PortfolioTranslationModel::all()->count();
        $totalEntries = Portfolio::all()->count();
        
        return view('livewire.portfolio.portfolio-translation', [
            // Styles
            'underlineMenuHeader'   => 'border-b-2 border-b-slate-400',
            'bgMenuColor'           => 'bg-slate-400',
            'menuTextColor'         => 'text-slate-400',
            'focusColor'            => 'focus:ring-slate-400 focus:border-slate-400',
            // Data
            'translations'          => $translations,
            'found'                 => $found,
            'column'                => $this->orderColumn,
            'totalTranslations'     => $totalTranslations,
            'totalEntries'          => $totalEntries,
        ])->layout('layouts.app');
    }
   
}
