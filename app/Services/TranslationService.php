<?php

namespace App\Services;

// Models
use App\Models\Languages;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Models\Portfolio\PortfolioTranslation;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TranslationService
{
    /**
     * Get All the Languages Codes in the APP
     */

    /* public function getLanguageCodes(): array
    {
        $languageCodes = Languages::orderBy('id', 'asc')->pluck('code')->all();
        return $languageCodes;
    } */

    /**
     * Get All the Languages Ids in the APP
     */

    public function getLanguageIds(): array
    {         
        return Languages::orderBy('id', 'asc')->pluck('id')->all();
    }

    /**
     * Given an Element get the Languages Ids for his translations
     */

     public function getElementTranslationsLanguageIds(Model $element): array
     {       
        $result = [];
        foreach ($element->translations as $translation) {
            $result[] = $translation->language->id;
        }
        return $result;
     }

    /**
     * Get Language Collection with the missing translations for the Category
     */

   /*  public function getPFCategoryTranslationsMissing(int $categoryId): Collection
    {
        $langIds = PortfolioCategoryTranslation::where('pf_cat_id', $categoryId)->pluck('lang_id')->toArray();
        $totalLangIds = $this->getLanguageIds();
        $translationsMissing = array_diff($totalLangIds, $langIds);

        return Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
    } */

    /**
     * Get Language Collection with the missing translations for the Type
     */

    /* public function getPFTypeTranslationsMissing(int $typeId): Collection
    {
        $langIds = PortfolioTypeTranslation::where('pf_type_id', $typeId)->pluck('lang_id')->toArray();
        $totalLangIds = $this->getLanguageIds();
        $translationsMissing = array_diff($totalLangIds, $langIds);

        return Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
    } */

    /**
     * Get Language Collection with the missing translations for given Table
     */

   /*  public function getTranslationsMissing($translationModel, string $idColumn, int $IdValue): Collection
    {
        //$model = new $translationModel();
        $langIds = $translationModel::where($idColumn, $IdValue)->pluck('lang_id')->toArray();
        $totalLangIds = $this->getLanguageIds();
        $translationsMissing = array_diff($totalLangIds, $langIds);

        return Languages::orderBy('id', 'asc')->whereIn('id', $translationsMissing)->get();
    } */



    public function getTranslationsMissingTest(Model $element): Collection
    {
        
        $elementLanguages = $this->getElementTranslationsLanguageIds($element);
        
        $totalLanguages = $this->getLanguageIds();

        $languagesMissing = array_diff($totalLanguages, $elementLanguages);

        return Languages::orderBy('id', 'asc')->whereIn('id', $languagesMissing)->get();       
    }

    /**
     * Given a Translation collection and a LanguageId check if there is already a translation for this languageId
     */

    public function isTranslated(Collection $translations, int $languageId): bool
    {
        $translatedLanguageIds = [];
        foreach ($translations as $translation) {
            $translatedLanguageIds[] = $translation->lang_id;
        }

        return in_array($languageId, $translatedLanguageIds) ? true : false;
    }

    /**
     * Insert a Translation in the DB
     * 
     * @param string table Name of the DB translation table
     * @param string elementColumn Column in the DB table for foreignKey that references the translation table
     * @param int elementId 
     * @param int languageId 
     * @param string translation 
     */

    public function insertTranslation(string $table, string $elementColumn, int $elementId, int $languageId, string $translation)
    {
        DB::table($table)->insert([
            $elementColumn => $elementId,
            'lang_id' => $languageId,
            'name' => $translation,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }    


    public function insertTranslationPortfolio(array $validated)
    {        
        $selectedTags = $validated['selectedTags'];
        unset($validated['selectedTags']);

        $portfolioTranslation = PortfolioTranslation::create($validated);
        $portfolioTranslation->tags()->sync($selectedTags);
    }

    /**
     * Insert a Translation for a Portfolio, also insert the tags in the pivot table
     * 
     */

     public function insertTranslationPortfolioTest(array $validatedData)
     {
        /* 1 - Extract the selectedTags from the validatedData */
        $selectedTags = $validatedData['selectedTags'];
        unset($validatedData['selectedTags']);

        $testini = PortfolioTranslation::create($validatedData);

        dd($testini);
        
        $roles = [1, 2, 6];
        //dd($roles);
        //dd($selectedTags);
        
        $portfolioTranslation = PortfolioTranslation::find(5);
        //$portfolioTranslation->tags()->attach($roles);
        foreach ($selectedTags as $tag) {
        DB::table('portfolios_trans_tags')->insert([
            'pf_id' => $portfolioTranslation->id,
            'tag_id' => $tag,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        }
        dd('oli');
        //dd($selectedTags);
        /* 2 - Insert the validatedData (without the selectedTags) in the table portfolios_translation */
        $portfolioTranslationId = DB::table('portfolios_translation')->insertGetId($validatedData);
        /* 
            3 - With the id of the inserted entry in the portfolios_translation and the ids of the selectedTags
                Insert in the pivot table portfolios_trans_tags
        */

        $portfolioTranslation = PortfolioTranslation::find($portfolioTranslationId);
        $portfolioTranslation->tags()->sync($selectedTags);

        
       /*  DB::table($table)->insert([
             $elementColumn => $elementId,
             'lang_id' => $languageId,
             'name' => $translation,
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => date('Y-m-d H:i:s'),
         ]); */
     }   

     public function updateTranslationPortfolio(PortfolioTranslation $portfolioTranslation, array $validated)
    {
        //var_dump($validated);
        //dd($portfolioTranslation);
        
        $selectedTags = $validated['selectedTags'];
        unset($validated['selectedTags']);

        $portfolioTranslation->update($validated);
        $portfolioTranslation->tags()->sync($selectedTags);
    }

     /**
      * Get an array with the id tags for the Portfolio Translation
      */

      public function getPortfolioTranslationTags(mixed $elementTags):array
     {
        $idTags = array();
        foreach($elementTags as $elementTag)
        {
            $idTags[] = $elementTag->id;
        }
        return $idTags;
     }


     /**
     * Given an element, get the array with information about the Translations already made and the pending ones
     * 
     */

     public function getListTranslations(model $element)
     { 
        $translationsPending = $this->getTranslationsMissingTest($element);
         
        $elementTranslations = array();
        foreach ($element->translations as $translation) {
            
            $elementTranslations[] = [
                "elementId" => $element->id,
                "translationId" => $translation->id,
                "code" => $translation->language->code,
                "lang" => $translation->language->name,
                "langId" => $translation->language->id,
                "translated" => true,
            ];
        }       
        
        $elementTranslationsPending = array();
        foreach ($translationsPending as $translationPending) {

            $elementTranslationsPending[] = [
                "elementId" => $element->id,
                "translationId" => null,
                "code" => $translationPending->code,
                "lang" => $translationPending->name,
                "langId" => $translationPending->id,
                "translated" => false,
            ];
        }
        // Array with information of ALL the translation of this element, the already made and the pending translations

        return array_merge($elementTranslations,$elementTranslationsPending);
     }
}
