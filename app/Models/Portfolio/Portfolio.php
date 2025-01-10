<?php

namespace App\Models\Portfolio;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{   
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'user_id',
        'published',
        'status',
        'position',
        'name',
        'description',
    ];

     /**
     * Get the user associated with the Sport.
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            foreignKey: 'user_id'
        );
    }

    /**
     * Get the translations associated.
     */
    public function translations()
    {
        return $this->hasMany(
            PortfolioTranslation::class,
            foreignKey: 'portfolio_id'
        );
    }

    /**
     * Get the Files associated.
     */
    public function files()
    {
        return $this->hasMany(
            PortfolioFile::class,
            foreignKey: 'portfolio_id'
        );
    }

}
