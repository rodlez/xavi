<?php

namespace App\Livewire\Portfolio\Categories\Translations;

use App\Models\Portfolio\PortfolioCategoryTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioCategoriesTranslation extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "pf_categories_trans.id";
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
            $category = PortfolioCategoryTranslation::find($selection);
            $category->delete();
        }

        return to_route('pf_categories')/* ->with('message', 'category successfully deleted.') */;
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

        $translations = PortfolioCategoryTranslation::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {

            $found = $translations->where('name', "like", "%" . $this->search . "%")->count();
        }

        $total = $translations->count();
        $translations = $translations->paginate($this->perPage);

    
        return view('livewire.portfolio.categories.translations.portfolio-categories-translation', [
            'translations'    => $translations,
            'found'         => $found,
            'column'        => $this->orderColumn,
            'total'         => $total,
        ])->layout('layouts.app');
    }
   
}
