<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioFile extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'portfolio_id',
        'original_filename',
        'storage_filename',
        'path',
        'media_type',
        'size',
        'width',
        'height',
        'orientation',
        'resolution',
        'position',
        'type',
        'title',
        'description',
    ];

    /**
     * Get the portfolio entry associated with the file.
     */
    public function portfolio()
    {
        return $this->belongsTo(
            Portfolio::class,
            foreignKey: 'portfolio_id'
        );
    }    

    /**
     * Get the translations associated.
     */
    public function translations()
    {
        return $this->hasMany(
            PortfolioFileTranslation::class,
            foreignKey: 'portfolio_file_id'
        );
    }
}
