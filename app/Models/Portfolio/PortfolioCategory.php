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
    
}
