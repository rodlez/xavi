<?php

namespace App\Models\Portfolio;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategoryTranslation extends Model
{
    protected  $table = 'pf_categories_trans';

    use HasFactory;

    protected $fillable = ['pf_cat_id ', 'lang_id', 'name'];

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class,
        foreignKey: 'pf_cat_id');
    }
    
    public function language()
    {
        return $this->belongsTo(Languages::class,
        foreignKey: 'lang_id');
    }
}
