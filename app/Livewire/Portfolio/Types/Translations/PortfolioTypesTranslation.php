<?php

namespace App\Livewire\Portfolio\Types\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioType;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioTypesTranslation extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = 'pf_types_trans.id';
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
            $element = PortfolioTypeTranslation::find($selection);
            $element->delete();
        }

        return to_route('pf_types_trans')->with('message', __('generic.bulkDelete'));
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

        $translations = PortfolioTypeTranslation::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $translations->where('name', 'like', '%' . $this->search . '%')->count();
        }

        $translations = $translations->paginate($this->perPage);

        // Stats
        $totalEntries = PortfolioType::all()->count();
        $entriesWithTranslations = PortfolioTypeTranslation::distinct()->pluck('pf_type_id')->count();
        $entriesWithoutTranslations = $totalEntries - $entriesWithTranslations;
        $totalTranslations = Languages::all()->count() * $totalEntries;
        $madeTranslations = PortfolioTypeTranslation::all()->count();

        return view('livewire.portfolio.types.translations.portfolio-types-translation', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-emerald-400',
            'textMenuHeader' => 'hover:text-emerald-800',
            'bgMenuColor' => 'bg-emerald-400',
            'menuTextColor' => 'text-emerald-400',
            'focusColor' => 'focus:ring-emerald-400 focus:border-emerald-400',
            // Data
            'translations' => $translations,
            'found' => $found,
            'column' => $this->orderColumn,
            // Stats
            'totalEntries' => $totalEntries,
            'entriesWithTranslations' => $entriesWithTranslations,
            'entriesWithoutTranslations' => $entriesWithoutTranslations,
            'totalTranslations' => $totalTranslations,
            'madeTranslations' => $madeTranslations,
        ])->layout('layouts.app');
    }
}
