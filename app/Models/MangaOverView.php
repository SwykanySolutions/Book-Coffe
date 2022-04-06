<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaOverView extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'background_photo', 'name', 'synopsis', 'format', 'status', 'views', 'score'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function people()
    {
        return $this->belongsToMany(People::class);
    }
}
