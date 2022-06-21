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

    public function chapter_mangas()
    {
        return $this->hasMany(ChapterManga::class);
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class);
    }

    public function formats()
    {
        return $this->belongsTo(Format::class);
    }
}
