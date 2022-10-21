<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Slider extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['background_photo', 'title_photo', 'manga_over_view_id'];

    protected $auditInclude = [
        'background_photo',
        'title_photo',
        'manga_over_view_id',
    ];

    public function getBackgroundPhotoAttribute()
    {
        return "storage/" . $this->attributes['background_photo'];
    }

    public function getTitlePhotoAttribute()
    {
        return "storage/" . $this->attributes['title_photo'];
    }

    public function manga_over_views()
    {
        return $this->hasOne(MangaOverView::class);
    }
}
