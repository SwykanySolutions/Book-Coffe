<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['score'];

    public function manga_over_views()
    {
        return $this->belongsTo(MangaOverView::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
