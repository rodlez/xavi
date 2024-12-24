<?php

namespace App\Models\Portfolio;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioFileTranslation extends Model
{
    protected  $table = 'portfolio_files_translation';

    use HasFactory;

    protected $fillable = ['portfolio_file_id', 'lang_id', 'title', 'description'];

    public function portfolioFile()
    {
        return $this->belongsTo(PortfolioFile::class,
        foreignKey: 'portfolio_file_id');
    }

    public function language()
    {
        return $this->belongsTo(Languages::class,
        foreignKey: 'lang_id');
    }

}
