<?php

namespace App\Services;

// Models
use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TranslationService
{
    /**
     * Get All the Languages Codes in the APP
     */

    public function getLanguageCodes(): array
    {
        $languageCodes = Languages::orderBy('id', 'asc')->pluck('code')->all();
        return $languageCodes;
    }

    /**
     * Get All the Languages Ids in the APP
     */

    public function getLanguageIds(): array
    {
        $languageIds = Languages::orderBy('id', 'asc')->pluck('id')->all();
        return $languageIds;
    }

    /**
     * Get Language Collection with the missing translations for the Category
     */

    public function getPFCategoryTranslationsMissing(int $categoryId): Collection
    {
        $langIds = PortfolioCategoryTranslation::where('pf_cat_id', $categoryId)->pluck('lang_id')->toArray();
        $totalLangIds = $this->getLanguageIds();
        $translationsMissing = array_diff($totalLangIds, $langIds);

        return Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
    }

    /**
     * Get Language Collection with the missing translations for the Type
     */

     public function getPFTypeTranslationsMissing(int $typeId): Collection
     {
         $langIds = PortfolioTypeTranslation::where('pf_type_id', $typeId)->pluck('lang_id')->toArray();
         $totalLangIds = $this->getLanguageIds();
         $translationsMissing = array_diff($totalLangIds, $langIds);
 
         return Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
     }

     /**
     * Get Language Collection with the missing translations for given Table
     */

    public function getTranslationsMissing($translationModel, string $idColumn, int $IdValue): Collection
    {
        //$model = new $translationModel();
        $langIds = $translationModel::where($idColumn, $IdValue)->pluck('lang_id')->toArray();
        $totalLangIds = $this->getLanguageIds();
        $translationsMissing = array_diff($totalLangIds, $langIds);

        return Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
    }


    /**
     * Given a CategoryId and a LanguageId check if there is already a translation
     */

    public function isTranslated(Collection $translations, int $languageId): bool
    {
        $translatedLanguageIds = [];
        foreach ($translations as $translation) {
            $translatedLanguageIds[] = $translation->lang_id;
        }       

       return (in_array($languageId, $translatedLanguageIds) ? true : false);
    }
}
