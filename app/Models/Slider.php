<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['background_photo', 'title_photo', 'manga_over_view_id'];

    public function getBackgroundPhotoAttribute()
    {
        return asset("storage/" . $this->attributes['background_photo']);
    }

    public function getTitlePhotoAttribute()
    {
        return asset("storage/" . $this->attributes['title_photo']);
    }

    public function manga_over_views()
    {
        return $this->hasOne(MangaOverView::class);
    }
}