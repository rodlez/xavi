<?php

namespace App\Livewire\Portfolio\Categories;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategory;
use App\Services\TranslationService;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioCategories extends Component
{
    use WithPagination;

    // Dependency Injection to use the Service
    protected TranslationService $translationService;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = 'pf_categories.id';
    public $sortOrder = 'desc';
    public $sortLink = '<i class="fa-solid fa-caret-down"></i>';
    public $search = '';
    public $perPage = 25;

    public $selections = [];

    public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

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
            $element = PortfolioCategory::find($selection);
            $element->delete();
        }

        return to_route('pf_categories')->with('message', __('generic.bulkDelete'));
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

    /**
     * Given the element model, check for missing translations.
     *
     * @return array With all the languages specifying which ones are missing.
     */

    public function translationLinks(Model $element): array
    {
        return $this->translationService->getListTranslations($element);
    }

    public function render()
    {
        $found = 0;

        $data = PortfolioCategory::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $data->where('name', 'like', '%' . $this->search . '%')->count();
        }

        $total = $data->count();
        $data = $data->paginate($this->perPage);

        return view('livewire.portfolio.categories.portfolio-categories', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-blue-600',
            'bgMenuColor' => 'bg-blue-800',
            'menuTextColor' => 'text-blue-800',
            'focusColor' => 'focus:ring-blue-500 focus:border-blue-500',
            // Data
            'categories' => $data,
            'found' => $found,
            'column' => $this->orderColumn,
            'total' => $total,
        ])->layout('layouts.app');
    }
}
