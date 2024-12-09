<?php

namespace App\Models\Portfolio;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTagTranslation extends Model
{
    protected  $table = 'pf_tags_trans';

    use HasFactory;

    protected $fillable = ['pf_tag_id', 'lang_id', 'name'];

    public function tag()
    {
        return $this->belongsTo(PortfolioTag::class,
        foreignKey: 'pf_tag_id');
    }
    
    public function language()
    {
        return $this->belongsTo(Languages::class,
        foreignKey: 'lang_id');
    }

    /* test pivot table */

    public function translations()
    {
        return $this->belongsToMany(
            PortfolioTranslation::class,
            table: 'portfolios_trans_tags',
            foreignPivotKey: 'tag_id',
            relatedPivotKey: 'pf_id',
        )->withTimestamps();
    }

}
