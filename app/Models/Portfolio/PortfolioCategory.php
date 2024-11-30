<?php

namespace App\Models\Portfolio;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    protected  $table = 'pf_categories';

    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get the translations associated.
     */
    public function translations()
    {
        return $this->hasMany(
            PortfolioCategoryTranslation::class,
            foreignKey: 'pf_cat_id'
        );
    }
    
}
