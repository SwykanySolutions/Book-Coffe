<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Format extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    public function manga_over_views()
    {
        return $this->hasMany(MangaOverView::class);
    }
}
