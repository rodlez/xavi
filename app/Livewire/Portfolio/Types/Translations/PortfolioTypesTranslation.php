<?php

namespace App\Livewire\Portfolio\Types\Translations;

use App\Models\Portfolio\PortfolioType;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioTypesTranslation extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "pf_types_trans.id";
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
            $element = PortfolioTypeTranslation::find($selection);
            $element->delete();
        }

        return to_route('pf_types')->with('message', 'Element successfully deleted.');
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

        $translations = PortfolioTypeTranslation::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {

            $found = $translations->where('name', "like", "%" . $this->search . "%")->count();
        }

        //$total = $translations->count();
        $translations = $translations->paginate($this->perPage);
        $totalTranslations = PortfolioTypeTranslation::all()->count();
        $totalEntries = PortfolioType::all()->count();
    
        return view('livewire.portfolio.types.translations.portfolio-types-translation', [
            // Styles
            'menuColor'             => 'emerald',
            'menuTextColor'         => 'text-emerald-800',
            // Data
            'translations'          => $translations,
            'found'                 => $found,
            'column'                => $this->orderColumn,
            'totalTranslations'     => $totalTranslations,
            'totalEntries'          => $totalEntries,
        ])->layout('layouts.app');
    }
    
}
