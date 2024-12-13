<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioCategoriesTranslation extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = 'pf_categories_trans.id';
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
            $element = PortfolioCategoryTranslation::find($selection);
            $element->delete();
        }

        return to_route('pf_categories_trans')->with('message', __('generic.bulkDelete'));
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

        $translations = PortfolioCategoryTranslation::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $translations->where('name', 'like', '%' . $this->search . '%')->count();
        }

        $translations = $translations->paginate($this->perPage);

        $totalTranslations = PortfolioCategoryTranslation::all()->count();
        $totalEntries = PortfolioCategory::all()->count();

        // Stats
        $totalEntries = PortfolioCategory::all()->count();
        $entriesWithTranslations = PortfolioCategoryTranslation::distinct()->pluck('pf_cat_id')->count();
        $entriesWithoutTranslations = $totalEntries - $entriesWithTranslations;
        $totalTranslations = Languages::all()->count() * $totalEntries;
        $madeTranslations = PortfolioCategoryTranslation::all()->count();

        return view('livewire.portfolio.categories.translations.portfolio-categories-translation', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-blue-400',
            'textMenuHeader' => 'hover:text-blue-800',
            'bgMenuColor' => 'bg-blue-400',
            'menuTextColor' => 'text-blue-400',
            'focusColor' => 'focus:ring-blue-400 focus:border-blue-400',
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
