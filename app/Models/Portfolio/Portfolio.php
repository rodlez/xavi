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

}
