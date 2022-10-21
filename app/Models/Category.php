<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $auditInclude = [
        'name',
    ];

    public function manga_over_views()
    {
        return $this->belongsToMany(MangaOverView::class);
    }
}
