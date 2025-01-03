<?php

namespace App\Models\Portfolio;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTypeTranslation extends Model
{
    protected  $table = 'pf_types_trans';

    use HasFactory;

    protected $fillable = ['pf_type_id', 'lang_id', 'name'];

    public function type()
    {
        return $this->belongsTo(PortfolioType::class,
        foreignKey: 'pf_type_id');
    }
    
    public function language()
    {
        return $this->belongsTo(Languages::class,
        foreignKey: 'lang_id');
    }

     /**
     * Get the portfolio translations associated.
     */
    public function portfoliotranslations()
    {
        return $this->hasMany(
            PortfolioTranslation::class,
            foreignKey: 'pf_type_trans_id'
        );
    }
}
