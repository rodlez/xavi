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
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-violet-600',
            'textMenuHeader' => 'hover:text-violet-800',
            'bgMenuColor' => 'bg-violet-800',
            'menuTextColor' => 'text-violet-800',
            // Data
            'language' => $this->language
        ])->layout('layouts.app');
    }
}
