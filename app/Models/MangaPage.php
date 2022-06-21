<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaPage extends Model
{
    use HasFactory;

    protected $fillable = ['page'];

    public function chapter_mangas()
    {
        return $this->hasOne(ChapterManga::class);
    }
}
