<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

class People extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'photo', 'background_photo','birth', 'gender', 'about', 'twitter', 'facebook', 'instagram', 'anilist', 'myanimelist', 'youtube', 'website'];

    protected $auditInclude = [
        'photo',
        'background_photo',
        'name',
        'birth',
        'gender',
        'about',
        'twitter',
        'facebook',
        'instagram',
        'anilist',
        'myanimelist',
        'youtube',
        'website',
    ];

    public function getPhotoAttribute()
    {
        return !$this->attributes['photo'] ? "imgs/profile.jpg" :  $this->attributes['photo'];
    }

    public function getBackgroundPhotoAttribute()
    {
        return !$this->attributes['background_photo'] ? "imgs/background_profile.jpg" :  $this->attributes['background_photo'];
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