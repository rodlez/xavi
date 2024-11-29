<?php

namespace App\Livewire\Languages;

use App\Models\Languages;
use Livewire\Component;

class LanguagesShow extends Component
{
    public Languages $language;

    public function mount(Languages $language)
    {
        $this->language = $language;
    }

    public function render()
    {
        //dd($this->language->code);
        return view('livewire.languages.languages-show', [
            'language' => $this->language
        ])->layout('layouts.app');
    }
}
