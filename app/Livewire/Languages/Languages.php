<?php

namespace App\Livewire\Languages;

use App\Models\Languages as ModelLanguage;
use Livewire\Component;
use Livewire\WithPagination;

class Languages extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "languages.id";
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
            $element = ModelLanguage::find($selection);
            $element->delete();
        }

        return to_route('languages')->with('message', __('generic.bulkDelete'));
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

        $languages = ModelLanguage::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $languages->where('name', "like", "%" . $this->search . "%")->count();
        }

        $total = $languages->count();
        $languages = $languages->paginate($this->perPage);

        return view('livewire.languages.languages', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-violet-600',
            'bgMenuColor' => 'bg-violet-800',
            'menuTextColor' => 'text-violet-800',
            'focusColor' => 'focus:ring-violet-500 focus:border-violet-500',
            // Data
            'languages' => $languages,
            'found'     => $found,
            'column'    => $this->orderColumn,
            'total'     => $total,
        ])->layout('layouts.app');
    }
}
