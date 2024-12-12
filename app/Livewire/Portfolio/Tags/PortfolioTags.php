<?php

namespace App\Livewire\Portfolio\Tags;

use App\Models\Languages;
use App\Models\Portfolio\PortfolioTag;
use App\Models\Portfolio\PortfolioTagTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
    

    /**
     * Given the element model, check for missing translations.
     * 
     * @return array With all the languages specifying which ones are missing.
     */

    public function translationLinks(model $element): array
    {
        // TODO: Refactor!!!
        
        //$langIds = $translationModel::where($idColumn, $IdValue)->pluck('lang_id')->toArray();
        // 1 - Get the translations for the element
        $elementTranslations = [];
        foreach ($element->translations as $translation) {
            //dd($translation);
            $elementTranslations[] = $translation->language->id;
        }

        $totalTranslations = Languages::orderBy('id', 'asc')->pluck('id')->all();

        $translationsMissing = array_diff($totalTranslations, $elementTranslations);

        /* echo 'TOTAL<br/>';
        var_dump($totalTranslations);
        echo '<br/><br/>';
        echo 'ELEMENT<br/>';
        var_dump($elementTranslations);
        echo '<br/><br/>';
        echo 'translationsMissing<br/>';
        var_dump($translationsMissing); */

        // 1 - Get the translations for the element
        $elementTranslations = [];
        foreach ($element->translations as $translation) {
            //dd($translation);
            $elementTranslations[] = [
                "elementId" => $translation->tag->id,
                "translationId" => $translation->id,
                "code" => $translation->language->code,
                "langId" => $translation->language->id,
                "translated" => true,
            ];
        }

       /*  echo '<br/><br/>';
        echo 'ELEMENT<br/>';
        var_dump($elementTranslations); */

        // 1 - Get the translations for the element
        //Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
        $translationsPending = Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
        
        $caca = array();
        foreach ($translationsPending as $missing) {
            //dd($missing);
            $caca[] = [
                "elementId" => $element->id,
                "translationId" => null,
                "code" => $missing->code,
                "langId" => $missing->id,
                "translated" => false,
            ];
        }
        $total = array_merge($elementTranslations,$caca);
       /*  echo '<br/><br/>';
        echo 'translationsPending<br/>';
        var_dump($caca);

        $total = array_merge($elementTranslations,$caca);

        echo '<br/><br/>';
        echo 'TOTAL<br/>';
        dd($total); */

        return $total;
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
