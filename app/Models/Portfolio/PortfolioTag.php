<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTag extends Model
{
    protected  $table = 'pf_tags';

    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get the translations associated.
     */
    public function translations()
    {
        return $this->hasMany(
            PortfolioTagTranslation::class,
            foreignKey: 'pf_tag_id'
        );
    }
}
