<?php

namespace App\Livewire\Portfolio\Tags\Translations;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioTag;
use App\Models\Portfolio\PortfolioTagTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioTagsTranslation extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = 'pf_tags_trans.id';
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
            $element = PortfolioTagTranslation::find($selection);
            $element->delete();
        }

        return to_route('pf_tags_trans')->with('message', __('generic.bulkDelete'));
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

        $translations = PortfolioTagTranslation::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $translations->where('name', 'like', '%' . $this->search . '%')->count();
        }

        $translations = $translations->paginate($this->perPage);

        // Stats
        $totalEntries = PortfolioTag::all()->count();
        $entriesWithTranslations = PortfolioTagTranslation::distinct()->pluck('pf_tag_id')->count();
        $entriesWithoutTranslations = $totalEntries - $entriesWithTranslations;
        $totalTranslations = Languages::all()->count() * $totalEntries;
        $madeTranslations = PortfolioTagTranslation::all()->count();

        return view('livewire.portfolio.tags.translations.portfolio-tags-translation', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-yellow-400',
            'textMenuHeader' => 'hover:text-yellow-800',
            'bgMenuColor' => 'bg-yellow-400',
            'menuTextColor' => 'text-yellow-400',
            'focusColor' => 'focus:ring-yellow-400 focus:border-yellow-400',
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
