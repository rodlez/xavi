<?php

namespace App\Models\Portfolio;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTranslation extends Model
{
    protected  $table = 'portfolios_translation';

    use HasFactory;

    protected $fillable = ['portfolio_id', 'pf_cat_trans_id', 'pf_type_trans_id', 'lang_id', 'title', 'subtitle', 'content', 'year', 'location', 'client', 'project'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class,
        foreignKey: 'portfolio_id');
    }
    
    public function category()
    {
        return $this->belongsTo(PortfolioCategoryTranslation::class,
        foreignKey: 'pf_cat_trans_id');
    }
    
    public function type()
    {
        return $this->belongsTo(PortfolioTypeTranslation::class,
        foreignKey: 'pf_type_trans_id');
    }
    
    public function language()
    {
        return $this->belongsTo(Languages::class,
        foreignKey: 'lang_id');
    }

    /* test pivot table */

    public function tags()
    {
        return $this->belongsToMany(
            PortfolioTagTranslation::class,
            table: 'portfolios_trans_tags',
            foreignPivotKey: 'pf_id',
            relatedPivotKey: 'tag_id',
        )->withTimestamps();
    }
}
