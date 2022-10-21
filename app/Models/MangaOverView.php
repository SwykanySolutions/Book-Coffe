<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

class MangaOverView extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use Searchable;

    protected $fillable = ['photo', 'background_photo', 'name', 'alternative_name', 'synopsis', 'format', 'status', 'views', 'score'];

    protected $auditInclude = [
        'photo',
        'background_photo',
        'name',
        'alternative_name',
        'synopsis',
    ];

    protected $hidden = ['status_id','format_id'];

    public function getPhotoAttribute()
    {
        return !$this->attributes['photo'] ? "imgs/cover.jpg" : "storage/" . $this->attributes['photo'];
    }

    public function getBackgroundPhotoAttribute()
    {
        return !$this->attributes['background_photo'] ? "imgs/background_profile.jpg" : "storage/" . $this->attributes['background_photo'];
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

    public function sliders()
    {
        return $this->belongsTo(Slider::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
