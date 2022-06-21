<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaOverView extends Model
{
    use HasFactory;

    protected $fillable = ['photo', 'background_photo', 'name', 'synopsis', 'format', 'status', 'views', 'score'];

    public function getPhotoAttribute()
    {
        return !$this->attributes['photo'] ? asset("imgs/profile.avif") : asset("storage/" . $this->attributes['photo']);
    }

    public function getBackgroundPhotoAttribute()
    {
        return !$this->attributes['background_photo'] ? asset("imgs/profile.avif") : asset("storage/" . $this->attributes['background_photo']);
    }

    public function getSynopsisAttribute()
    {
        return !$this->attributes['synopsis'] ? "Nenhuma sinopse" : $this->attributes['synopsis'];
    }

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
