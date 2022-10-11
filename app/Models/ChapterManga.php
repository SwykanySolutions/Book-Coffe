<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterManga extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'chapter'];

    public function getTitleAttribute()
    {
        return !$this->attributes['title'] ? "Sem Titulo" : $this->attributes['title'];
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function manga_over_views()
    {
        return $this->belongsTo(MangaOverView::class, 'manga_over_view_id');
    }

    public function manga_pages()
    {
        return $this->hasMany(MangaPage::class);
    }
}
