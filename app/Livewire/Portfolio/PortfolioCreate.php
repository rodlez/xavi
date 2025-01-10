<?php

namespace App\Livewire\Portfolio;

use App\Http\Requests\Portfolio\StorePortfolioRequest;
use App\Models\Portfolio\Portfolio;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PortfolioCreate extends Component
{
    public $published;
    public $status;
    public $position;
    public $name;
    public $description;

    /**
     * USE LARAVEL FORM REQUEST IN LIVEWIRE
     * In Livewire Component you can add rules in the rules() method by returning an array. 
     * In this method, you can return the rules() method from your Form Request. 
     * Just don't forget that public properties in Livewire Component need to be the same name as in the rules.
     */
    
    protected function rules(): array
    {
        return (new StorePortfolioRequest())->rules();
    }

    protected function messages(): array
    {
        return (new StorePortfolioRequest())->messages();
    }   

    public function mount()
    {
        $this->published = false;
        $this->status = 0;
    }

    public function save()
    {
        $formData = $this->validate();
        $formData['user_id'] = Auth::id();
        
        try {
            Portfolio::create($formData);

            return to_route('portfolios')->with('message', __("generic.type") . ' (' . $this->name . ') '. __("generic.successCreate"));
        } catch (Exception $e) {
            return to_route('portfolios')->with('error', __("generic.error") . ' (' . $e . ') ' .__("generic.type"). ' (' . $this->name . ') '. __("generic.errorCreate"));
        }
    }

    public function render()
    {
        return view('livewire.portfolio.portfolios.portfolio-create', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-800',
            'bgInfoTab' => 'bg-orange-600',
            'tagName' => 'text-white font-bold bg-orange-600',
            'menuInfo' => 'text-white bg-slate-800',
            'bgMenuColor' => 'bg-slate-800',
            'bgInfoColor' => 'bg-slate-100',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            ])->layout('layouts.app');
    }
    
}
