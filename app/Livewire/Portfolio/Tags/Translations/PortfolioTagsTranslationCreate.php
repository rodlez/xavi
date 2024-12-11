<?php

namespace App\Livewire\Portfolio\Tags\Translations;

use App\Http\Requests\Portfolio\StorePFTagTranslationRequest;
use App\Models\Languages;
use App\Models\Portfolio\PortfolioTag;
use App\Services\TranslationService;
use Exception;
use Livewire\Component;

class PortfolioTagsTranslationCreate extends Component
{
    // Dependency Injection to use the Service
    protected TranslationService $translationService;

    public PortfolioTag $tag;
    public string $missingTranslationId;
    public $name;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array.
     * In this method, you can return the rules() method from your Form Request.
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */

    protected function rules(): array
    {
        return (new StorePFTagTranslationRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StorePFTagTranslationRequest())->messages();
    }

    public function boot(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function mount(PortfolioTag $tag, ?string $missingTranslationId = '')
    {
        $this->tag = $tag;
        // optional parameter to make the translation from the PortfolioTagShow Component
        $this->missingTranslationId = $missingTranslationId;
    }

    public function save()
    {
        // TODO: No insert the current cataegory id as pf_tag_id
        // Error(PDOException: SQLSTATE[HY000]: General error: 1364 Field 'pf_tag_id' doesn't have a default value

        $this->validate();

        // Get the language of the translation to show on the returned success or fail message
        $languageName = Languages::where('id', $this->missingTranslationId)
            ->pluck('name')
            ->first();

        try {
            $this->translationService->insertTranslation('pf_tags_trans', 'pf_tag_id', $this->tag->id, $this->missingTranslationId, $this->name);
            return to_route('pf_tags.show', $this->tag)->with('message', __('generic.translation') . ' (' . $languageName . ') ' . __('generic.successCreate'));
        } catch (Exception $e) {
            return to_route('pf_tags.show', $this->tag)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $languageName . ') ' . __('generic.errorCreate'));
        }
    }

    public function render()
    {
        // 1 - Check if the missingTranslationId is a valid Translation Language
        $translationLanguage = Languages::where('id', $this->missingTranslationId)->first();

        if (!$translationLanguage) {
            abort(404, 'Language not found');
        }

        // 2 - Check if the Language have already a translation. if so, no need to give the option to create a new one.
        $isTranslated = $this->translationService->isTranslated($this->tag->translations, $this->missingTranslationId);

        return view('livewire.portfolio.tags.translations.portfolio-tags-translation-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-yellow-400',
            'textMenuHeader' => 'hover:text-yellow-400',
            'bgMenuColor' => 'bg-yellow-400',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgTranslationTab' => 'bg-pink-600',
            'languageName' => 'text-pink-600 italic',
            'translationName' => 'text-white font-bold bg-pink-600',
            'menuTranslation' => 'text-white bg-slate-800',
            'menuTextColor' => 'text-yellow-400',
            'focusColor' => 'focus:ring-yellow-400 focus:border-yellow-400',
            // Data
            'tag' => $this->tag,
            'languages' => Languages::all(),
            'translationLanguage' => $translationLanguage,
            'isTranslated' => $isTranslated,
        ])->layout('layouts.app');
    }
  
}
