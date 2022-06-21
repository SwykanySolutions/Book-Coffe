<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo', 'background_photo','birth', 'gender', 'about', 'twitter', 'facebook', 'instagram', 'anilist', 'myanimelist', 'youtube', 'website'];

    public function getPhotoAttribute()
    {
        return !$this->attributes['photo'] ? asset("imgs/profile.jpg") : asset("storage/" . $this->attributes['photo']);
    }

    public function getBackgroundPhotoAttribute()
    {
        return !$this->attributes['background_photo'] ? asset("imgs/background_profile.jpg") : asset("storage/" . $this->attributes['background_photo']);
    }

    public function getGenderAttribute()
    {
        return !$this->attributes['gender'] ? 'Desconhecido' : $this->attributes['gender'];
    }

    public function getAboutAttribute()
    {
        return !$this->attributes['about'] ? 'Nada' : $this->attributes['about'];
    }

    public function manga_over_views()
    {
        return $this->belongsToMany(MangaOverView::class);
    }
}
