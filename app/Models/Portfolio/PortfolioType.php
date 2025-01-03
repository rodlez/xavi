<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioType extends Model
{
    protected  $table = 'pf_types';

    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get the translations associated.
     */
    public function translations()
    {
        return $this->hasMany(
            PortfolioTypeTranslation::class,
            foreignKey: 'pf_type_id'
        );
    }
   
}
